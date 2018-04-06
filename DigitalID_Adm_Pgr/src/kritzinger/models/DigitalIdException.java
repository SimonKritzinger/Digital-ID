package kritzinger.models;

public class DigitalIdException extends Exception {


    private int status;

    public DigitalIdException(String msg, int status) {
        super(msg);
        this.status = status;
    }

    public int getStatus() {
        return status;
    }
}