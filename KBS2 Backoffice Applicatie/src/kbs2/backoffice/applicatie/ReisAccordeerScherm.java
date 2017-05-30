/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;

/**
 *
 * @author svdberg
 */
public class ReisAccordeerScherm extends JFrame implements ActionListener {

    private JButton home;
    private JButton help;
    private JButton vorigPakket;
    private JButton volgendePakket;
    private JButton slaOpmerkingOp;
    private JButton allesAccoderen;
    private JLabel banner;
    private JLabel pakketreferentie;
    private JLabel klantGegevens;

    public ReisAccordeerScherm() {
        setLayout(new GridBagLayout());
        GridBagConstraints grid = new GridBagConstraints();

        home = new JButton();
      //  grid.fill = GridBagConstraints.HORIZONTAL;
        grid.gridx = 0;
        grid.gridy = 0;

        banner = new JLabel("Accorderen uitgevoerde activiteiten");
      
      //  grid.fill = GridBagConstraints.HORIZONTAL;
        grid.gridx = 1;
        grid.gridy = 0;
          add(banner, grid);
        
        //TODO svdberg. Path werkt waarschijnlijk niet op Linux.
        ImageIcon homeIcon = new ImageIcon(new ImageIcon("src\\icons\\home-icon.png").getImage().getScaledInstance(20, 20, Image.SCALE_DEFAULT));
        home.setIcon(homeIcon);
        add(home, grid);
        home.addActionListener(this);

        help = new JButton();
    //    grid.fill = GridBagConstraints.HORIZONTAL;
        grid.gridx = 2;
        grid.gridy = 0;
        add(help, grid);

        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(550, 500);
        setTitle("Accorderen uitgevoerde activiteiten");
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource().equals(home)) {
            dispose();
            Tabel tabel = new Tabel();
            tabel.setVisible(true);
        }
    }
}
