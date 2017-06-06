/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
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
    private JButton hoofdscherm;
    private JButton volgende;

    private JPanel mainPanel;
    private JPanel topPanel;
    private JPanel botPanel;
    private JPanel klantReferentiePanel;
    private JPanel klantGegevensPanel;
    private JPanel opmerkingenPanel;

    private TrajectRecord record1;
    private TrajectRecord record2;
    private TrajectRecord record3;

    private String klantGegevensTekst;
    private int aantalTrajecten;

    private int trajectId1;
    private int trajectId2;
    private int trajectId3;

    private int referentie;

    public ReisAccordeerScherm(int referentie) {
        this.referentie = referentie;
        try {
            ResultSet trajecten = DatabaseHelper.voerQueryUit("SELECT * FROM TrajectDelen td JOIN Traject t ON td.traject_id=t.traject_id WHERE td.opdracht_id=" + referentie + " ORDER BY t.traject_id DESC");
            ResultSet klant = DatabaseHelper.voerQueryUit(" SELECT k.naam FROM Bezorgopdracht b JOIN Klant k ON b.klant_id=k.klant_id WHERE pakket_id=" + referentie);
            while (klant.next()) {
                klantGegevensTekst = klant.getString("naam");
            }
            while (trajecten.next()) {
                aantalTrajecten++;
                switch (aantalTrajecten) {
                    case 1:
                        trajectId1 = Integer.parseInt(trajecten.getString("traject_id"));
                        break;
                    case 2:
                        trajectId2 = Integer.parseInt(trajecten.getString("traject_id"));
                        break;
                    case 3:
                        trajectId3 = Integer.parseInt(trajecten.getString("traject_id"));
                        break;
                }
            }

        } catch (SQLException ex) {
            Logger.getLogger(ReisAccordeerScherm.class.getName()).log(Level.SEVERE, null, ex);
        }

        mainPanel = new JPanel();
        mainPanel.setLayout(new GridLayout(6, 0));
        add(mainPanel);

        topPanel = new JPanel();
        topPanel.setLayout(new GridLayout(0, 3));
        mainPanel.add(topPanel);

        if (aantalTrajecten >= 1) {
            record1 = new TrajectRecord(trajectId1, 1);
            mainPanel.add(record1);
        }
        if (aantalTrajecten >= 2) {
            record2 = new TrajectRecord(trajectId2, 2);
            mainPanel.add(record2);
        }

        if (aantalTrajecten >= 3) {
            record3 = new TrajectRecord(trajectId3, 3);
            mainPanel.add(record3);
        }

        botPanel = new JPanel();
        botPanel.setLayout(new FlowLayout());
        mainPanel.add(botPanel);

        klantReferentie = new JTextField(6);
        klantReferentie.setEditable(false);
        klantReferentie.setText("" + referentie);

        klantReferentieLabel = new JLabel("Klantreferentie");

        accordeerAlle = new JButton("Accordeer alle");
        accordeerAlle.setEnabled(false);

        klantReferentiePanel = new JPanel();
        klantReferentiePanel.setLayout(new GridLayout(3, 0));
        klantReferentiePanel.add(klantReferentieLabel);
        klantReferentiePanel.add(klantReferentie);
        klantReferentiePanel.add(accordeerAlle);

        klantGegevens = new JTextArea(3, 20);
        klantGegevens.setEditable(false);
        klantGegevens.setText(klantGegevensTekst);

        klantGegevensLabel = new JLabel("Klantgegevens");

        pasAan = new JButton("Pas aan");
        pasAan.addActionListener(this);

        klantGegevensPanel = new JPanel();
        klantGegevensPanel.setLayout(new GridLayout(3, 0));
        klantGegevensPanel.add(klantGegevensLabel);
        klantGegevensPanel.add(klantGegevens);
        klantGegevensPanel.add(pasAan);

        opmerkingen = new JTextField(15);

        opmerkingenLabel = new JLabel("Opmerkingen");

        voegOpmerkingToe = new JButton("Voeg opmerking toe");

        opmerkingenPanel = new JPanel();
        opmerkingenPanel.setLayout(new GridLayout(3, 0));
        opmerkingenPanel.add(opmerkingenLabel);
        opmerkingenPanel.add(opmerkingen);
        opmerkingenPanel.add(voegOpmerkingToe);

        topPanel.add(klantReferentiePanel);
        topPanel.add(klantGegevensPanel);
        topPanel.add(opmerkingenPanel);

        vorige = new JButton("< vorig pakket");
        hoofdscherm = new JButton("terug naar hoofdscherm");
        volgende = new JButton("volgend pakket >");

        botPanel.add(vorige);
        vorige.addActionListener(this);
        botPanel.add(hoofdscherm);
        hoofdscherm.addActionListener(this);
        botPanel.add(volgende);
        volgende.addActionListener(this);

        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(1280, 700);
        setTitle("TZT koeriersdienst: goedkoop en groen!");
    }

    @Override
    public void actionPerformed(ActionEvent e
    ) {
        if (e.getSource().equals(hoofdscherm)) {
            dispose();
            Tabel tabel = new Tabel();
            tabel.setVisible(true);
        }
        if (e.getSource().equals(volgende)) {
            dispose();
            ReisAccordeerScherm scherm = new ReisAccordeerScherm(referentie + 1);
            scherm.setVisible(true);
        }
        if (e.getSource().equals(vorige)) {
            dispose();
            ReisAccordeerScherm scherm = new ReisAccordeerScherm(referentie - 1);
            scherm.setVisible(true);
        }
        if (e.getSource().equals(pasAan)) {
            klantGegevens.setEditable(true);
        }
    }

}
