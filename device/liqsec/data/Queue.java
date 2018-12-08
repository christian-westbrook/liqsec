package liqsec.data;

import java.io.IOException;

public class Queue
{
	public Node head;
	public int size;
	String deviceID;

	public Queue(String deviceID)
	{
		this.deviceID = deviceID;
		size = 0;
	}

	public void push(Node n)
	{
		if(size == 0 && head == null)
		{
			head = n;
		}
		else
		{
			Node current = head;

			while(current.next != null)
			{
				current = current.next;
			}

			current.next = n;
		}

		size++;

		if(size == 8)
		{
			StringBuilder plaintext = new StringBuilder();

			Node current = head;

			while(current.next != null)
			{
				plaintext.append(Integer.toString(current.n));
				current = current.next;
			}

			plaintext.append(Integer.toString(current.n));

			// Send request
			dump(plaintext.toString());

			head = null;
			size = 0;
		}
	}

	private void dump(String plaintext)
	{
		try
		{
			Runtime.getRuntime().exec("php verify.php " + plaintext + " " + deviceID);
		}
		catch (IOException ex)
		{
			ex.printStackTrace();
		}
	}
}
