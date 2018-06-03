package kritzinger.gui.panels;

import javafx.embed.swing.SwingFXUtils;
import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.control.TitledPane;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import kritzinger.models.Citizen;
import kritzinger.models.DigitalIdException;
import kritzinger.models.Utils;

import java.awt.image.BufferedImage;

public class ShowCitizenPanelController {
    private Citizen c;

    @FXML
    private Label nameLabel, birthDateLabel, birthPlaceLabel,
            addressLabel, placeLabel, provinceLabel, stateLabel,
            maritalStatusLabel, occupationLabel, heightLabel,
            hairLabel, eyesLabel, statusLabel;

    @FXML
    private TextArea specialMarksTextArea;
    @FXML
    private TitledPane titledPane;
    @FXML
    private ImageView pictureImageView;

    public void setCitizen(Citizen c){
        this.c = c;
        titledPane.setText(c.getName() + " " + c.getLastname());
        nameLabel.setText(c.getName() + " " + c.getLastname());
        birthDateLabel.setText(Utils.getGermanDate(c.getBirthDate()));
        if(c.getBirthPlace().getProvince().getState().getName().equals("Italien"))
            birthPlaceLabel.setText(c.getBirthPlace().getName() + "(" + c.getBirthPlace().getProvince().getName()+")");
        else
            birthPlaceLabel.setText(c.getBirthPlace().getName() + "(" + c.getBirthPlace().getProvince().getName()+", "+
                    c.getBirthPlace().getProvince().getState().getName()+")");

        addressLabel.setText(c.getStreet() + " " + c.getHouseNumber());
        placeLabel.setText(c.getPlace().getName());
        provinceLabel.setText(c.getPlace().getProvince().getName());
        stateLabel.setText(c.getPlace().getProvince().getState().getName());
        if(c.getMaritalStatus() != null)
            maritalStatusLabel.setText(c.getMaritalStatus());
        else
            maritalStatusLabel.setText("/");
        if(c.getOccupation() != null)
            occupationLabel.setText(c.getOccupation());
        else
            occupationLabel.setText("/");
        heightLabel.setText(c.getHeight()+"");
        hairLabel.setText(c.getHair());
        eyesLabel.setText(c.getEyes());
        if(c.getState() != null)
            statusLabel.setText(c.getState());
        else
            statusLabel.setText("/");
        if(c.getSpecialMarks() != null)
            specialMarksTextArea.setText(c.getSpecialMarks());
        else
            specialMarksTextArea.setText("/");
        try {
            BufferedImage picture = c.getPicture();
            if(picture != null)
                pictureImageView.setImage( SwingFXUtils.toFXImage(picture, null));
        } catch (Exception e) {
            generateErrorMessage(e);
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
}
