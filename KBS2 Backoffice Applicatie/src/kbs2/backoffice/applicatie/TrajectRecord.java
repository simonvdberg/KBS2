/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.awt.Dimension;
import java.awt.FlowLayout;
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

    public TrajectRecord() {
        
        String kolomNamen[] = {"Traject", "Startpunt", "Eindpunt", "Uitvoerder", "Afstand", "Inkoopkosten", "Aflevermoment", "Status", "Akkoord", "Moment"};
        Object data[][] = {
            {"1", "Barneveld", "Zwolle", "Fietskoeriers", "3812 meter", "9,00", "28-05-17, 16:31", "Afgeleverd", "JA", "30-05-17, 08:17"}
        };
        model = new NietBewerkbaarModel(data, kolomNamen);
        
        setLayout(new FlowLayout());
        JTable table = new JTable();
        table.setModel(model);
        table.setPreferredScrollableViewportSize(new Dimension(1100, 16));
        table.setFillsViewportHeight(true);
        JScrollPane scrollPane = new JScrollPane(table);
        add(scrollPane);
    }

}
