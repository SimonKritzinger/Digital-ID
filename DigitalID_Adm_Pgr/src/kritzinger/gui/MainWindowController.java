package kritzinger.gui;

import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.control.*;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.AnchorPane;
import kritzinger.gui.panels.ShowCitizenPanelController;
import kritzinger.models.Citizen;
import kritzinger.models.DigitalIdException;

import java.io.IOException;
import java.util.List;

public class MainWindowController {

    @FXML
    private TextField searchNameField, searchTaxIdField, searchLastnameField;
    @FXML
    private Button searchByNameButton, searchByTaxIdButton, newButton, showButton, editButton, newCardButton, deleteCardButton, showAccountButton, newAccountButton;
    @FXML
    private ListView searchResultList;
    @FXML
    private ContextMenu citizenContextMenu;
    @FXML
    private Menu idContextMenu, accountContextMenu;
    @FXML
    private MenuItem showContext, newContext,changeContext, idRemoveConext, idAddContext, accountShowContext, accountAddContext;
    @FXML
    private AnchorPane contentPane;

    public MainWindowController(){

    }

    public void searchByNameClick(){
        searchLastnameField.getStyleClass().remove("error");
        searchNameField.getStyleClass().remove("error");
        if(searchNameField.getText().length() > 0 && searchLastnameField.getText().length() >0){
            try {
                searchResultList.getItems().clear();
                List<Citizen> citizen = Citizen.getCitizenByName(searchNameField.getText(),searchLastnameField.getText());
                for(Citizen c : citizen){
                    searchResultList.getItems().add(c);
                }
                searchLastnameField.setText("");
                searchNameField.setText("");
            } catch (Exception e) {
                generateErrorMessage(e);
            }
        }
        else{
            if(searchLastnameField.getText().length() == 0)
                searchLastnameField.getStyleClass().add("error");
            if(searchNameField.getText().length() == 0)
                searchNameField.getStyleClass().add("error");
        }
    }

    public void searchByTaxIdClick(){
        searchTaxIdField.getStyleClass().remove("error");
        if(searchTaxIdField.getText().length() > 0) {
            try {
                searchResultList.getItems().removeAll();
                Citizen citizen = Citizen.getCitizenByTaxId(searchTaxIdField.getText());
                searchResultList.getItems().add(citizen);
                searchTaxIdField.setText("");
            } catch (Exception e) {
                generateErrorMessage(e);
            }
        }
        else{
            searchTaxIdField.getStyleClass().add("error");
        }
    }

    public void citizenContextMenuOpen(){
        if(searchResultList.getSelectionModel().getSelectedItem() != null){
            idContextMenu.setDisable(false);
            accountContextMenu.setDisable(false);
            showContext.setDisable(false);
            changeContext.setDisable(false);
        }
        else{
            idContextMenu.setDisable(true);
            accountContextMenu.setDisable(true);
            showContext.setDisable(true);
            changeContext.setDisable(true);
        }
    }

    public void searchResultListClick(){
        boolean isSelected = searchResultList.getSelectionModel().getSelectedItem() == null;
        showButton.setDisable(isSelected);
        editButton.setDisable(isSelected);
        newCardButton.setDisable(isSelected);
        deleteCardButton.setDisable(isSelected);
        showAccountButton.setDisable(isSelected);
        newAccountButton.setDisable(isSelected);
    }

    public void showCitizenClick(){
        if(searchResultList.getSelectionModel().getSelectedItem() != null) {
            FXMLLoader fxmlLoader = new FXMLLoader(getClass().getResource("panels/ShowCitizenPanel.fxml"));
            fxmlLoader.setRoot(contentPane);
            try {
                fxmlLoader.load();
            } catch (IOException e) {
                e.printStackTrace();
            }
            ShowCitizenPanelController showCitizenPanelController = fxmlLoader.<ShowCitizenPanelController>getController();
            showCitizenPanelController.setCitizen((Citizen) searchResultList.getSelectionModel().getSelectedItem());
        }
    }

    private void generateErrorMessage(Exception e){
        Alert alert = new Alert(Alert.AlertType.WARNING);
        if(e instanceof DigitalIdException)
            alert.setTitle("Achtung! Fehler" + ((DigitalIdException)e).getStatus());
        else
            alert.setTitle("Achtung!");
        alert.setHeaderText(e.getMessage());
        alert.showAndWait();
    }

    public void initialize(){
        searchResultList.setOnMousePressed(new EventHandler<MouseEvent>() {
            @Override
            public void handle(MouseEvent event) {
                if (event.isPrimaryButtonDown() && event.getClickCount() == 2) {
                    showCitizenClick();
                }
            }
        });
    }

}
