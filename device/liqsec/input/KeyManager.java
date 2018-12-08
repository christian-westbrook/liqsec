package liqsec.input;

import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

import liqsec.data.Node;
import liqsec.data.Queue;

public class KeyManager implements KeyListener
{
	private Queue q;

	public KeyManager(Queue q)
	{
		this.q = q;
	}

	@Override
	public void keyPressed(KeyEvent e)
	{

	}

	@Override
	public void keyReleased(KeyEvent e)
	{
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD0)
		{
			q.push(new Node(0));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD1)
		{
			q.push(new Node(1));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD2)
		{
			q.push(new Node(2));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD3)
		{
			q.push(new Node(3));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD4)
		{
			q.push(new Node(4));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD5)
		{
			q.push(new Node(5));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD6)
		{
			q.push(new Node(6));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD7)
		{
			q.push(new Node(7));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD8)
		{
			q.push(new Node(8));
		}
		if(e.getKeyCode() == KeyEvent.VK_NUMPAD9)
		{
			q.push(new Node(9));
		}
	}

	@Override
	public void keyTyped(KeyEvent e)
	{

	}
}
