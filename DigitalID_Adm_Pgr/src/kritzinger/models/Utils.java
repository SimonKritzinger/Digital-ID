package kritzinger.models;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;

public class Utils {

    public static Date getDate(String date){
            Date ret = null;
            try{
                DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                ret = dateFormat.parse(date);
            }catch (Exception e){}
            return  ret;
    }

    public static String getGermanDate(String date){
        Calendar cal = Calendar.getInstance();
        cal.setTime(getDate(date));
        String ret = cal.get(Calendar.DAY_OF_MONTH)+"."
                + (cal.get(Calendar.MONTH) + 1) +"."
                + cal.get(Calendar.YEAR);
        return ret;
    }
}
