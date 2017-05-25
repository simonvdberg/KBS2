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

    private static Connection maakVerbinding() throws SQLException {
        return DriverManager.getConnection("jdbc:mysql://localhost:3307/TZT", "root", "");
    }

    public static ResultSet voerQueryUit(String query) throws SQLException {
        Statement statement = maakVerbinding().createStatement();
        maakVerbinding().close();
        return statement.executeQuery(query);
    }
}
