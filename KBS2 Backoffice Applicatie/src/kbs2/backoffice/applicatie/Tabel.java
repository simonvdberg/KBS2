/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.*;
import javax.swing.*;

/**
 *
 * @author svdberg
 */
public class Tabel extends JFrame {

    JTable table;

    public Tabel() {
        setLayout(new FlowLayout());

        String kolomNamen[] = {"Referentie", "Startpunt", "Eindpunt", "Afleverdag", "Deeltrajecten"};

        Object data[][] = {
                    {"1235123", "Barneveld", "Zwolle", "Donderdag", "3"}
                };
        
        table = new JTable(data, kolomNamen);
        table.setPreferredScrollableViewportSize(new Dimension(500,50));
        table.setFillsViewportHeight(true);
        
        JScrollPane scrollPane = new JScrollPane(table);
        add(scrollPane);
    }
}
