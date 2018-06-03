package kritzinger.models;


import javassist.bytecode.analysis.Util;

import javax.imageio.ImageIO;
import javax.ws.rs.client.ClientBuilder;
import javax.ws.rs.core.GenericType;
import javax.ws.rs.core.Response;
import javax.xml.bind.annotation.XmlRootElement;
import java.awt.image.BufferedImage;
import java.io.ByteArrayInputStream;
import java.util.Base64;
import java.util.Calendar;
import java.util.List;

@XmlRootElement
public class Citizen {

    private String name, maritalStatus, state, lastname, taxId, hash, birthDate, street, houseNumber, occupation, hair, eyes, specialMarks, deletDate, created_at, updated_at;
    private boolean gender, deleted;
    private Place birthPlace, place;
    private int c_id, height;
    private BufferedImage picture;

    public static List<Citizen> getCitizenByName(String name, String lastname) throws Exception{
        List<Citizen> ret = null;
        Response response = ClientBuilder.newClient()
                .target("http://localhost/DigitalID/public/api")
                .path("citizen/name/{vorname}/lastname/{nachname}")
                .resolveTemplate("vorname",name)
                .resolveTemplate("nachname",lastname)
                .request()
                .get();
        if (response.getStatus() == 404) {
            if(response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                throw new DigitalIdException("Kein Bürger gefunden!",response.getStatus());
            else
                throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
        }
        else if(response.getStatus()!= 200){
            if(response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                throw new DigitalIdException("Fehler beim Suchen!",response.getStatus());
            else
                throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
        } else {
            ret = response.readEntity(new GenericType<List<Citizen>>(){});
        }
        return ret;
    }

    public static Citizen getCitizenByTaxId(String taxId) throws Exception{
        Citizen ret = null;
        Response response = ClientBuilder.newClient()
                .target("http://localhost/DigitalID/public/api")
                .path("citizen/taxId/{taxId}")
                .resolveTemplate("taxId",taxId)
                .request()
                .get();
        if (response.getStatus() == 404) {
            if(response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                throw new DigitalIdException("Kein Bürger gefunden!",response.getStatus());
            else
                throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
        }
        else if(response.getStatus()!= 200){
            if(response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                throw new DigitalIdException("Fehler beim Suchen!",response.getStatus());
            else
                throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
        } else {
            ret = response.readEntity(Citizen.class);
        }
        return ret;
    }

    public int getC_id() {
        return c_id;
    }

    public void setC_id(int c_id) {
        this.c_id = c_id;
    }


    public int getHeight() {
        return height;
    }

    public void setHeight(int height) {
        this.height = height;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getMaritalStatus() {
        return maritalStatus;
    }

    public void setMaritalStatus(String maritalStatus) {
        this.maritalStatus = maritalStatus;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getLastname() {
        return lastname;
    }

    public void setLastname(String lastname) {
        this.lastname = lastname;
    }

    public String getTaxId() {
        return taxId;
    }

    public void setTaxId(String taxId) {
        this.taxId = taxId;
    }

    public String getHash() {
        return hash;
    }

    public void setHash(String hash) {
        this.hash = hash;
    }

    public String getBirthDate() {
        return birthDate;
    }

    public void setBirthDate(String birthDate) {
        this.birthDate = birthDate;
    }

    public String getStreet() {
        return street;
    }

    public void setStreet(String street) {
        this.street = street;
    }

    public String getHouseNumber() {
        return houseNumber;
    }

    public void setHouseNumber(String houseNumber) {
        this.houseNumber = houseNumber;
    }

    public String getOccupation() {
        return occupation;
    }

    public void setOccupation(String occupation) {
        this.occupation = occupation;
    }

    public String getHair() {
        return hair;
    }

    public void setHair(String hair) {
        this.hair = hair;
    }

    public String getEyes() {
        return eyes;
    }

    public void setEyes(String eyes) {
        this.eyes = eyes;
    }

    public String getSpecialMarks() {
        return specialMarks;
    }

    public void setSpecialMarks(String specialMarks) {
        this.specialMarks = specialMarks;
    }

    public String getDeletDate() {
        return deletDate;
    }

    public void setDeletDate(String deletDate) {
        this.deletDate = deletDate;
    }

    public String getCreated_at() {
        return created_at;
    }

    public void setCreated_at(String created_at) {
        this.created_at = created_at;
    }

    public String getUpdated_at() {
        return updated_at;
    }

    public void setUpdated_at(String updated_at) {
        this.updated_at = updated_at;
    }

    public boolean isGender() {
        return gender;
    }

    public void setGender(boolean gender) {
        this.gender = gender;
    }

    public boolean isDeleted() {
        return deleted;
    }

    public void setDeleted(boolean deleted) {
        this.deleted = deleted;
    }

    public Place getBirthPlace() {
        return birthPlace;
    }

    public void setBirthPlace(Place birthPlace) {
        this.birthPlace = birthPlace;
    }

    public Place getPlace() {
        return place;
    }

    public void setPlace(Place place) {
        this.place = place;
    }


    @Override
    public String toString() {
        return this.getName()+" " + this.getLastname()+ ";" + Utils.getGermanDate(this.getBirthDate());

    }

    public BufferedImage getPicture() throws Exception{
        if(this.picture == null) {
            Response response = ClientBuilder.newClient()
                    .target("http://localhost/DigitalID/public/api")
                    .path("citizen/picture/id/{id}")
                    .resolveTemplate("id", c_id)
                    .request()
                    .get();
            if (response.getStatus() == 404) {
                if (response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                    throw new DigitalIdException("Kein Bürger gefunden!", response.getStatus());
                else
                    throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
            } else if (response.getStatus() != 200) {
                if (response.readEntity(String.class).startsWith("<!DOCTYPE html>"))
                    throw new DigitalIdException("Fehler beim Suchen!", response.getStatus());
                else
                    throw new DigitalIdException(response.readEntity(String.class), response.getStatus());
            } else {
                byte[] p = Base64.getDecoder().decode(response.readEntity(String.class));
                this.picture = ImageIO.read(new ByteArrayInputStream(p));
            }
        }
        return this.picture;
    }

    public void setPicture(BufferedImage picture){
        this.picture = picture;
    }
}
