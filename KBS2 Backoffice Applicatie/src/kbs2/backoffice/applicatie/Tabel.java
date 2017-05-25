/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.*;
import javax.swing.*;
import javax.swing.event.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;

/**
 *
 * @author svdberg
 */
public class Tabel extends JFrame {

    String kolomNamen[] = {"Referentie", "Startpunt", "Eindpunt", "Afleverdag", "Deeltrajecten"};

    Object data[][] = {
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"}
    };

    private TableModel model;

    public Tabel() {
        model = new NietBewerkbaarModel(data, kolomNamen);
        setLayout(new FlowLayout());             
        JTable table = new JTable();
        table.setModel(model);
        table.setPreferredScrollableViewportSize(new Dimension(500, 50));
        table.setFillsViewportHeight(true);
        table.getSelectionModel().addListSelectionListener((ListSelectionEvent e) -> {
            System.out.println("TEST");
        });

        JScrollPane scrollPane = new JScrollPane(table);
        add(scrollPane);
    }
}
