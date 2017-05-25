/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package kbs2.backoffice.applicatie;

import java.sql.*;

/**
 *
 * @author svdberg
 */
public class DatabaseHelper {

    public static Connection maakVerbinding() throws SQLException {
        return DriverManager.getConnection("jdbc:mysql://localhost:3307/TZT", "root", "");
    }
}
