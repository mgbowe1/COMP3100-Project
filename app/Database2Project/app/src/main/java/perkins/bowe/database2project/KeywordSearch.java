package perkins.bowe.database2project;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class KeywordSearch extends AppCompatActivity {
    TextView UserNameT;
    private RecyclerView mRecyclerView;
    private RecyclerView.Adapter mRVAdapter;
    private RecyclerView.LayoutManager mRVLayoutMan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_keyword_search);

        configureReturnButton();

        Intent intent = this.getIntent();
        Bundle b = intent.getExtras();
        if (b != null) {
            String test = b.getString("json");
            int count = 0;
            String location = "";
            JSONObject c = null, postObject = null;
            JSONArray locationArray = null;
            try {
                c = new JSONObject(test);
                locationArray = c.getJSONArray("result");
                ArrayList<Keyword> keywords = new ArrayList<>();
                for (int i = 0; i < locationArray.length(); i++) {
                    postObject = locationArray.getJSONObject(i);
                    count = postObject.getInt("count");
                    location = postObject.getString("location");
                    keywords.add(new Keyword(count, location));
                }
                mRecyclerView = (RecyclerView) findViewById(R.id.keywordResults);

                mRVLayoutMan = new LinearLayoutManager(this);
                mRecyclerView.setLayoutManager(mRVLayoutMan);

                mRVAdapter = new MyKeywordSearchResultsRecyclerViewAdapter(keywords, new KeywordSearchResultsFragment.OnListFragmentInteractionListener() {
                    @Override
                    public void onListFragmentInteraction(Keyword keyword) {

                    }
                });
                mRecyclerView.setAdapter(mRVAdapter);
            } catch (JSONException e) {
                e.printStackTrace();
            }
            //String tempString = count + location;
            //UserNameT.setText(test);
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
