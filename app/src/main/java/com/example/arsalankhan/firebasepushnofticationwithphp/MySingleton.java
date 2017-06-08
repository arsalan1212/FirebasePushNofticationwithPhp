package com.example.arsalankhan.firebasepushnofticationwithphp;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/**
 * Created by Arsalan khan on 6/8/2017.
 */

public class MySingleton {
    private static MySingleton mInstance;
    private static Context context;
    private RequestQueue requestQueue;


    private MySingleton(Context context){
        this.context=context;
        requestQueue=getRequestQueue();
    }

    private RequestQueue getRequestQueue() {

        if(requestQueue==null){
            requestQueue= Volley.newRequestQueue(context.getApplicationContext());
        }
        return requestQueue;
    }

    public static synchronized MySingleton getInstance(Context context){
        if(mInstance==null){
            mInstance=new MySingleton(context);
        }
        return mInstance;
    }


    public <T> void addToRequestQueue(Request<T> request){
        getRequestQueue().add(request);
    }
}
