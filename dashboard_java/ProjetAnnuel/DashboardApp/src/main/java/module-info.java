module com.example.dashboardapp {
    requires javafx.controls;
    requires javafx.fxml;
    requires java.sql;


    opens com.example.dashboardapp to javafx.fxml;
    exports com.example.dashboardapp;
}