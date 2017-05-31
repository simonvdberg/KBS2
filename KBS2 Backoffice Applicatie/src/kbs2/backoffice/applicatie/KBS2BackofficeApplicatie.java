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

/**
 *
 * @author svdberg
 */
public class KBS2BackofficeApplicatie {
    
    public static void main(String[] args) {
        try {
            ResultSet result = DatabaseHelper.voerQueryUit("SELECT * FROM Koerier");
            while (result.next()) {
                System.out.println(result.getString("naam"));
            }
        } catch (SQLException ex) {
            Logger.getLogger(KBS2BackofficeApplicatie.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        Tabel tabel = new Tabel();
        tabel.setVisible(true);
 
    }
    
}
