package perkins.bowe.database2project;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

public class UserFeed extends AppCompatActivity {
    TextView UserNameT;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_userfeed);
        UserNameT = findViewById(R.id.tBody);
        String TAG = "MyActivity";

        configureReturnButton();

        Intent intent = this.getIntent();
        Bundle b = intent.getExtras();

        if (b != null) {
            String test = b.getString("json");
            String test2 = "";
            String tid = "", body = "", time = "", uid = "", name = "", comments = "";
            //String[] names;
            //Log.i(TAG, test);

            JSONObject c = null, cr = null;
            try {
                c = new JSONObject(test);
                cr = c.getJSONObject("result");
                /*if ( cr.length() == 1) {
                    name = cr.getString("result");
                }*/
                //JSONArray jsonArray = c.getJSONArray("result");
                //cr = jsonArray.getJSONObject(0);
                //name = cr.getString("name");
            } catch (JSONException e) {
                e.printStackTrace();
            }

            UserNameT.setText(test); // SET THE TEXT TO THE WHOLE JSON
        }
    }

    private void configureReturnButton() {
        Button returnButton = findViewById(R.id.btnReturn);
        returnButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
}
