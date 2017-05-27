/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.*;
import java.awt.event.WindowEvent;
import javax.swing.*;
import javax.swing.event.*;
import javax.swing.table.TableModel;

/**
 *
 * @author svdberg
 */
public class Tabel extends JFrame {

    String kolomNamen[] = {"Referentie", "Startpunt", "Eindpunt", "Afleverdag", "Deeltrajecten"};

    Object data[][] = {
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"},
        {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"}
    };

    private TableModel model;

    public Tabel() {
        model = new NietBewerkbaarModel(data, kolomNamen);
        setLayout(new FlowLayout());
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(550, 500);
        setTitle("Te accoderen");
        JTable table = new JTable();
        table.setModel(model);
        table.setPreferredScrollableViewportSize(new Dimension(500, 425));
        table.setFillsViewportHeight(true);
        table.getSelectionModel().addListSelectionListener((ListSelectionEvent e) -> {
            dispose();
            ReisAccordeerScherm reisAccordeerScherm = new ReisAccordeerScherm();
            reisAccordeerScherm.setVisible(true);
        });

        JScrollPane scrollPane = new JScrollPane(table);
        add(scrollPane);
    }
}
