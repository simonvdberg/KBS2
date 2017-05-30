/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.GridLayout;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextArea;
import javax.swing.JTextField;

/**
 *
 * @author svdberg
 */
public class ReisAccordeerScherm extends JFrame implements ActionListener {

    private JTextField klantReferentie;
    private JLabel klantReferentieLabel;
    private JButton accordeerAlle;

    private JTextArea klantGegevens;
    private JLabel klantGegevensLabel;
    private JButton pasAan;
    
    private JTextField opmerkingen;
    private JLabel opmerkingenLabel;
    private JButton voegOpmerkingToe;
    
    private JButton vorige;
    private JButton volgende;

    private JPanel mainPanel;
    private JPanel topPanel;
    private JPanel botPanel;
    private JPanel klantReferentiePanel;
    private JPanel klantGegevensPanel;
    private JPanel opmerkingenPanel;
    
    private TrajectRecord record;
    

    
    public ReisAccordeerScherm() {
        mainPanel = new JPanel();
        mainPanel.setLayout(new GridLayout(3,0));
        add(mainPanel);
        
        topPanel = new JPanel();
        topPanel.setLayout(new GridLayout(0, 3));
        mainPanel.add(topPanel);
                
        record = new TrajectRecord();

        record = new TrajectRecord();
        mainPanel.add(record);
        
        botPanel = new JPanel();
        botPanel.setLayout(new FlowLayout());
        mainPanel.add(botPanel);
        
        klantReferentie = new JTextField(6);
        klantReferentie.setEditable(false);
        klantReferentie.setText("123123123");

        klantReferentieLabel = new JLabel("Klantreferentie");

        accordeerAlle = new JButton("Accordeer alle");

        klantReferentiePanel = new JPanel();
        klantReferentiePanel.setLayout(new GridLayout(3, 0));
        klantReferentiePanel.add(klantReferentieLabel);
        klantReferentiePanel.add(klantReferentie);
        klantReferentiePanel.add(accordeerAlle);

        klantGegevens = new JTextArea(3, 20);
        klantGegevens.setEditable(false);
        klantGegevens.setText("Piet Klaas\nZwolle\n01231234");
       
        klantGegevensLabel = new JLabel("Klantgegevens");
        
        pasAan = new JButton("Pas aan");
        
        klantGegevensPanel = new JPanel();
        klantGegevensPanel.setLayout(new GridLayout(3,0));
        klantGegevensPanel.add(klantGegevensLabel);
        klantGegevensPanel.add(klantGegevens);
        klantGegevensPanel.add(pasAan);
        
        opmerkingen = new JTextField(15);
        
        opmerkingenLabel = new JLabel("Opmerkingen");
        
        voegOpmerkingToe = new JButton("Voeg opmerking toe");
        
        opmerkingenPanel = new JPanel();
        opmerkingenPanel.setLayout(new GridLayout(3,0));
        opmerkingenPanel.add(opmerkingenLabel);
        opmerkingenPanel.add(opmerkingen);
        opmerkingenPanel.add(voegOpmerkingToe);
        
        topPanel.add(klantReferentiePanel);
        topPanel.add(klantGegevensPanel);
        topPanel.add(opmerkingenPanel);
        
        vorige = new JButton("< vorig te accorderen pakket");
        volgende = new JButton("volgende te accorderen pakket >");
        
        botPanel.add(vorige);
        botPanel.add(volgende);
        
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(1280, 500);
        setTitle("TZT koeriersdienst: goedkoop en groen!");
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (e.getSource().equals(klantReferentie)) {
            dispose();
            Tabel tabel = new Tabel();
            tabel.setVisible(true);
        }
    }
}
