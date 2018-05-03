package perkins.bowe.database2project;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

public class KeywordSearch extends AppCompatActivity {
    TextView UserNameT;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_keyword_search);
        UserNameT = findViewById(R.id.tBody);

        configureReturnButton();

        Intent intent = this.getIntent();
        Bundle b = intent.getExtras();
        if (b != null) {
            String test = b.getString("json"), test2 = "";
            JSONObject c, cr = null;
            try {
                c = new JSONObject(test);
                //c.length();
                //cr = c.getJSONObject("result");
                //test2 = cr.getString("location");
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
