// =========================================================================
// System     : LiqSec
// Repository : https://github.com/christian-westbrook/liqsec.git
// File       : LiqSec.java
// Developers : Nathan Brown, Nicholas Leonard, and Christian Westbrook
// Version    : Pre-release
// Abstract   : LiqSec device application.
// =========================================================================

package liqsec;

import java.awt.BorderLayout;
import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;

import liqsec.data.Queue;
import liqsec.input.KeyManager;

@SuppressWarnings("serial")
public class LiqSec extends JFrame
{
	public String deviceID = "1";

	// Screen dimensions
	final int SCREEN_WIDTH = 800;
	final int SCREEN_HEIGHT = 480;

	// JFrame variables
	JButton lessButton;
	JButton moreButton;
	JLabel  value;
	JLabel message;
	JPanel panel;

	public LiqSec()
	{
		// Initialize JFrame variables
		panel = new JPanel(new GridBagLayout());
		GridBagConstraints c = new GridBagConstraints();
		c.fill = GridBagConstraints.HORIZONTAL;

		lessButton = new JButton("Less");
		lessButton.addActionListener(new LessButtonListener());
		moreButton = new JButton("More");
		moreButton.addActionListener(new MoreButtonListener());
		value = new JLabel("12 oz");
		message = new JLabel("");

		// Panel
		c.gridx = 0;
		c.gridy = 0;
		c.insets = new Insets(0,0,0,10);
		panel.add(lessButton, c);
		c.insets = new Insets(0,0,0,0);

		c.gridx = 3;
		c.gridy = 0;
		panel.add(value, c);

		c.gridx = 5;
		c.gridy = 0;
		c.insets = new Insets(0,10,0,0);
		panel.add(moreButton, c);
		c.insets = new Insets(0,0,0,0);


		c.gridx = 3;
		c.gridy = 1;
		c.insets = new Insets(5,0,0,0);
		panel.add(message, c);
		panel.setFocusable(true);
		panel.requestFocus();
		KeyManager keyManager = new KeyManager(new Queue(deviceID));
		panel.addKeyListener(keyManager);
		this.add(panel, BorderLayout.CENTER);

		// Configure JFrame Settings
		this.setTitle("LiqSec");
		this.setDefaultCloseOperation(EXIT_ON_CLOSE);
		this.setLocationRelativeTo(null);
		this.setMinimumSize(new Dimension(SCREEN_WIDTH, SCREEN_HEIGHT));
		this.setMaximumSize(new Dimension(SCREEN_WIDTH, SCREEN_HEIGHT));
		this.setPreferredSize(new Dimension(SCREEN_WIDTH, SCREEN_HEIGHT));
		this.setResizable(false);


		this.setVisible(true);
	}

	private class MoreButtonListener implements ActionListener
	{
		public void actionPerformed(ActionEvent e)
		{
			int ounces = Integer.parseInt(value.getText().substring(0, 2));
			ounces++;

			if(ounces > 44)
				return;

			StringBuilder newValue = new StringBuilder();
			newValue.append(Integer.toString(ounces));
			if(ounces < 10)
			{
				newValue.insert(0, '0');
			}
			newValue.append(" oz");
			value.setText(newValue.toString());
		}
	}

	private class LessButtonListener implements ActionListener
	{
		public void actionPerformed(ActionEvent e)
		{
			int ounces = Integer.parseInt(value.getText().substring(0, 2));
			ounces--;

			if(ounces < 0)
				return;

			StringBuilder newValue = new StringBuilder();
			newValue.append(Integer.toString(ounces));
			if(ounces < 10)
			{
				newValue.insert(0, '0');
			}
			newValue.append(" oz");
			value.setText(newValue.toString());
		}
	}

	public static void main(String[] args)
	{
		new LiqSec();
	}
}
