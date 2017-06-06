/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.*;
import java.awt.event.WindowEvent;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.*;
import javax.swing.event.*;
import javax.swing.table.TableModel;

/**
 *
 * @author svdberg
 */
public class Tabel extends JFrame{

    public static String[] setTabelWaardes() {
        try {
            ResultSet result = DatabaseHelper.voerQueryUit("SELECT * FROM Bezorgopdracht");
            while (result.next()) {
                System.out.println(result.getString("pakket_id"));
                System.out.println(result.getString("startpunt"));
                System.out.println(result.getString("eindpunt"));
                String[] waardes = {result.getString("pakket_id"), result.getString("eindpunt"), result.getString("startpunt")};
                return waardes;
            }
        } catch (SQLException ex) {
            Logger.getLogger(KBS2BackofficeApplicatie.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }

    String[] tabelWaardes = setTabelWaardes();

    String kolomNamen[] = {"Referentie", "Startpunt", "Eindpunt", "Deeltrajecten"};

    Object data[][] = {};

    private TableModel model;

    public Tabel() {
        model = new NietBewerkbaarModel(data, kolomNamen);
        setLayout(new FlowLayout());
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(1100, 500);
        setTitle("Te accorderen");
        JTable table = new JTable();
        table.setModel(model);
        table.setPreferredScrollableViewportSize(new Dimension(1000, 425));
        table.setFillsViewportHeight(true);
        table.getSelectionModel().addListSelectionListener((ListSelectionEvent e) -> {
            int row = table.getSelectedRow();
            int referentie = Integer.parseInt(table.getValueAt(row, 0).toString());
            dispose();
            ReisAccordeerScherm reisAccordeerScherm = new ReisAccordeerScherm(referentie);
            reisAccordeerScherm.setVisible(true);
        });

        JScrollPane scrollPane = new JScrollPane(table, JScrollPane.VERTICAL_SCROLLBAR_ALWAYS, JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
        add(scrollPane);
    }
}
