/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import javax.swing.table.DefaultTableModel;

/**
 *
 * @author svdberg
 */
public class NietBewerkbaarModel extends DefaultTableModel {

    public NietBewerkbaarModel(Object[][] data, Object[] columnNames) {
        super(data, columnNames);
    }

    @Override
    public boolean isCellEditable(int row, int column) {
        return false;
    }
}
