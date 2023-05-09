package com.example.dashboardapp;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;
import javafx.scene.control.PasswordField;
import javafx.scene.control.Label;
import javafx.stage.Stage;

import java.sql.Connection;

public class HelloController {

    @FXML
    private Button quitButton;
    @FXML
    private Label loginMessageLabel;
    @FXML
    private TextField emailTextField;
    @FXML
    private PasswordField mdpPasswordField;

    public void connectionButtonOnAction(ActionEvent e){
        if (emailTextField.getText().isBlank() == false && mdpPasswordField.getText().isBlank() == false) {
            //loginMessageLabel.setText("Ok !");
            validationConnection();
        } else {
            loginMessageLabel.setText("Remplissez les champs !");
        }
    }

    public void quitButtonOnAction(ActionEvent e){
        Stage stage = (Stage) quitButton.getScene().getWindow();
        stage.close();
    }

    public void validationConnection() {
        DatabaseConnection connectNow = new DatabaseConnection();
        Connection connectDB = connectNow.getConnection();
    }
}
