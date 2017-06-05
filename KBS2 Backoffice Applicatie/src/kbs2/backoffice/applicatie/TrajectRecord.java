/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.Dimension;
import java.awt.GridLayout;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JButton;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.table.TableModel;

/**
 *
 * @author svdberg
 */
public class TrajectRecord extends JPanel {

    private TableModel model;

    private JPanel top;
    private JPanel bot;

    private JButton accordeer;
    private JButton wijsAf;

    private String referentie;
    private String startpunt;
    private String eindpunt;
    private String koerierId;
    private String koerier;
    private String afstand;
    private String prijs;
    private String aflevermoment;
    private String Status;

    public TrajectRecord(int trajectId, int rijNummer) {
        setLayout(new GridLayout(2, 0));
        try {
            ResultSet traject = DatabaseHelper.voerQueryUit("SELECT * FROM Traject WHERE traject_id=" +trajectId);
            while(traject.next()){
                startpunt = traject.getString("startpunt");
                eindpunt = traject.getString("eindpunt");
                koerierId = traject.getString("koerier_id");
                prijs = traject.getString("vergoeding");
            }
            ResultSet koerierResult = DatabaseHelper.voerQueryUit("SELECT * FROM Koerier WHERE koerier_id=" + koerierId);
            while(koerierResult.next()){
                koerier = koerierResult.getString("naam");
            }
        } catch (SQLException ex) {
            Logger.getLogger(TrajectRecord.class.getName()).log(Level.SEVERE, null, ex);
        }
        String kolomNamen[] = {"Traject", "Startpunt", "Eindpunt", "Uitvoerder", "Inkoopkosten", "Status", "Akkoord"};
        Object data[][] = {
            {rijNummer, startpunt, eindpunt, koerier, prijs, "Af te leveren", "NEE"}
        };
        model = new NietBewerkbaarModel(data, kolomNamen);

        top = new JPanel();
        bot = new JPanel();

        add(top);
        add(bot);

        JTable table = new JTable();
        table.setModel(model);
        table.setPreferredScrollableViewportSize(new Dimension(1250, 16));
        table.setFillsViewportHeight(true);
        JScrollPane scrollPane = new JScrollPane(table);

        top.add(scrollPane);

        accordeer = new JButton("Accordeer");
        wijsAf = new JButton("Wijs af");

        bot.add(accordeer);
        bot.add(wijsAf);
    }
}
