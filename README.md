# System design of a liquid security solution

### Introduction

The distribution and security of alcoholic liquids is of primary importance to an alcoholic beverage industry boasting sales in the U.S. in excess of $200,000,000,000 for five consecutive years. In this we describe and partially implement a system intended to allow authorized users the ability to securely distribute specified quantities of alcoholic beverages, but that could realistically be applied to most situations where the secure storage of a liquid is necessary. The provided partial implementation of the described system is not production ready, and would require further engineering for the development of a production ready implementation.

### Specification

The proposed system consists of a centralized cluster of servers that provides authentication functions and tracks authorized users, and a series of client devices that provide for the secure storage of liquid assets.

The cluster consists of a relational database and web system. This can initially be achieved with a single server, but for redundancy and scalability it is advised to implement data replication. Furthermore, a series of replicated databases allow for additional security by not providing a single point of failure should the contents of a database become compromised. A polling system working with a series of replicated databases could detect compromised nodes, potentially preventing a compromised database from manipulating the data or queries necessary to provide security.

The client devices consist of a locking container for storing liquids securely, a valve for distribution, a number pad, and an Internet connected embedded system for reading input from the number pad and for controlling the valve and the lock on the container.

Users intending to administer one, or several, of these devices will purchase the desired number of client devices and then register an account with the web system. Each manufactured device is sent with a registration key that can be used in the web system to register a device, or devices, so that they are associated with an administrator's account.

A user that registers a device is designated as the device administrator, and has rights to lock and unlock the container, and to distribute from the device. An administrator can also control the rights that other system users have with regards to a particular device. In addition, an administrator can group devices so that the rights to an entire group of devices can be managed simultaneously. This is particularly useful in settings where a single administrator is responsible for managing the rights of groups of devices at different physical locations, with different users to manage the rights for. Users that are not administrators will register accounts with the web system, but will require an administrator to grant rights before they are able to perform any given action with any client device.

The client device itself uses the number pad as an interface. A user will have a unique PIN associated with themselves. When a user enters their PIN into the device, along with an operation code to specify whether the user is wanting to distribute liquid, lock, or unlock the device, the database can verify whether or not the user has permission to perform the requested action. If the database determines that an authorized user is performing an unauthorized action, then the action is performed. For every attempt, including every successful action, a report is logged concerning the type of request, the PIN used to request, and the time of the request.

### Implementation

The web system was implemented in PHP on a Linux system and hosted through a local Apache HTTP server. The relational database was implemented with a local MariaDB server. SQL injection and timing attacks were prevented through the use of standard PHP API functions for the secure hashing of passwords and PINs, and for the secure comparison of hashed values. For the purposes of academic demonstration only administrator accounts were able to be registered, and PINs were associated with devices rather than users.

The client device was implemented with a Raspberry Pi 3 computer. A controller application written in Java compares the entered PINs with the values stored in the database through a JDBC driver. If a user enters a valid PIN, then the controller application turns on a general purpose input-output pin on the Pi. This pin is connected to a relay for a 12v solenoid magnetic valve. When the pin is turned on, power is provided to the relay, and the circuit for the solenoid magnetic valve is closed. When the circuit is closed, the valve opens and allows the flow of liquids. After a specified amount of time the pin is turned off, causing the relay to open the circuit to the valve, causing the valve to close again. A GUI developed in Swing on the device allows the user to input a variable number of ounces of liquid, which affects the amount of time that the valve is opened. The constant used to store the amount of time the valve should be opened to allow a single oz. of liquid to pour is untested, and is furthermore an oversimplification of the physics of fluid dynamics. 

### Evaluation

The client side device operates almost as intended. We ran into an issue with a firewall that prevented our device from being able to connect to the MariaDB server, and as such removed the snippet of code comparing the input PIN to the correct PIN in the database such that any entered 8 digit PIN will currently trigger the opening and closing of the device. Furthermore, our team was unable to test the amount of time it would take to pour a single oz. of water, and as such the constant used to store the amount of time the valve should be opened was removed for the demonstration. The device simply opens, waits a fixed amount of time, and closes when an 8 digit PIN is entered.

### Future Work

Further development should include role management options for administrators and the addition of non-administrative user accounts, along with rights management options for administrators. Development of the theoretical fluid dynamics model used to associate an amount of time with the number of ounces of a liquid with a given viscosity should also continue and iterate for different liquids. Finally, further testing should be done in tandem with a publicly accessible relational database server in order to ensure security.

### References

Beverage Information Group. (n.d.). Total alcoholic beverage sales in the United States from 2006 to 2017 (in million U.S. dollars). In Statista - The Statistics Portal. Retrieved December 13, 2018, from https://www.statista.com/statistics/207936/us-total-alcoholic-beverages-sales-since-1990/.
