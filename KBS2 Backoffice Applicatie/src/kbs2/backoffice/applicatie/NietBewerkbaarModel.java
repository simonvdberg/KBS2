/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.table.DefaultTableModel;

/**
 *
 * @author svdberg
 */
public class NietBewerkbaarModel extends DefaultTableModel {

    public NietBewerkbaarModel(Object[][] data, Object[] columnNames) {
        super(data, columnNames);
        getAndSetAlleTabelWaardes();
    }

    @Override
    public boolean isCellEditable(int row, int column) {
        return false;
    }

    public final void getAndSetAlleTabelWaardes() {
        try {
            ResultSet res = DatabaseHelper.voerQueryUit("SELECT * FROM Bezorgopdracht");
            while (res.next()) {
                Object[] rijen = new Object[5];
                for (int i = 0; i < rijen.length; i++) {
                    rijen[0] = res.getString("pakket_id");
                    rijen[1] = res.getString("startpunt");
                    rijen[2] = res.getString("eindpunt");
                    rijen[3] = "Donderdag";
                    ResultSet deelTrajecten = DatabaseHelper.voerQueryUit("SELECT count( *) as deeltrajecten FROM Bezorgopdracht B JOIN TrajectDelen T ON B.opdracht_id = T.opdracht_id WHERE B.opdracht_id =" + res.getString("opdracht_id"));
                    while (deelTrajecten.next()) {
                        rijen[4] = deelTrajecten.getInt("deeltrajecten");
                    }
                }
                this.addRow(rijen);
            }
        } catch (SQLException ex) {
            Logger.getLogger(Tabel.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
}
