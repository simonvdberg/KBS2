/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Image;
import java.io.File;
import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.imageio.ImageIO;
import javax.swing.Icon;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;

/**
 *
 * @author svdberg
 */
public class ReisAccordeerScherm extends JFrame {

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
        grid.fill = GridBagConstraints.HORIZONTAL;
        grid.gridx = 0;
        grid.gridy = 0;
        try {
            //TODO svdberg. Path werkt waarschijnlijk niet op Linux.
            File file = new File("src\\icons\\home-icon.png");  
            Image homeIcon = ImageIO.read(file);
            home.setIcon(new ImageIcon(homeIcon));
        } catch (IOException ex) {
            Logger.getLogger(ReisAccordeerScherm.class.getName()).log(Level.SEVERE, null, ex);
        }

        // try {
        //    Image img = ImageIO.read(getClass().getResource("resources/water.bmp"));
        //    home.setIcon(new ImageIcon(img));
        //} catch (Exception ex) {
        //  System.out.println(ex);
        //}
        add(home, grid);
        help = new JButton("help");
        grid.fill = GridBagConstraints.HORIZONTAL;
        grid.gridx = 0;
        grid.gridy = 1;
        add(help, grid);

        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(550, 500);
        setTitle("Accorderen uitgevoerde activiteiten");
    }
}
