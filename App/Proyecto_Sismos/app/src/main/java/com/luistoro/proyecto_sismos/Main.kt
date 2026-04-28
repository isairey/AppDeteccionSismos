package com.luistoro.proyecto_sismos

import Operaciones.ListaSismos
import Operaciones.Sismo
import android.content.Context
import android.content.Intent
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.view.*
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.MarkerOptions
import com.google.android.gms.maps.MapView
import android.widget.Button
import kotlinx.android.synthetic.main.menu.*
import java.io.BufferedReader
import java.io.InputStreamReader
import java.lang.Double
import java.util.*
import kotlin.collections.ArrayList
import kotlin.reflect.KClass

class Main : AppCompatActivity(), OnMapReadyCallback {
    private lateinit var mMap: GoogleMap
    protected var mMapView: MapView? = null
    private var listaSismo: ListaSismos? = null

    fun onCreateView(inflater: LayoutInflater, parent: ViewGroup, savedInstanceState: Bundle): View {
        val view = inflater.inflate(R.layout.activity_maps, parent, false)
        mMapView = view.findViewById<MapView?>(R.id.mapView)
        mMapView!!.onCreate(savedInstanceState)
        return view
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.menu)
        val mapFragment = supportFragmentManager.findFragmentById(R.id.map) as SupportMapFragment
        mapFragment.getMapAsync(this)
        val boton = findViewById<Button>(R.id.estadistica)
        boton.setOnClickListener {
            val intento1 = Intent(this, Estadistica::class.java)
            startActivity(intento1)
        }
        val boton2 = findViewById<Button>(R.id.salida)
        boton2.setOnClickListener{
            finishAffinity()
        }
    }

    override fun onMapReady(googleMap: GoogleMap) {
        mMap = googleMap
        cargarDatos()
        val lista = listaSismo?.listaSismos
        val media = LatLng(-1.5, -78.79)
        mMap.setMaxZoomPreference(12.0f)
        mMap.setMinZoomPreference(5.7f)
        if (lista != null) {
            for (i in lista) {
                val sismo = LatLng(i.lat, i.lng)
                mMap.addMarker(MarkerOptions().position(sismo).title("${i.fecha} Sismo de ${i.grado} en${i.ubicacion} a ${i.prof} km de profundidad").flat(false))
            }
        }
        mMap.moveCamera(CameraUpdateFactory.newLatLng(media))
    }

    fun cargarDatos() = try {
        val fileReader = this.resources.openRawResource(R.raw.markers)
        val bufferedReader = BufferedReader(InputStreamReader(fileReader))
        var linea: String? = bufferedReader.readLine()
        var ltsis = LinkedList<Sismo>()
        while (linea != null) {
            val linasplit = linea.split(";".toRegex()).dropLastWhile { it.isEmpty() }.toTypedArray()
            val sismo = Sismo(Double.valueOf(linasplit[0])!!, Double.valueOf(linasplit[1])!!, Double.valueOf(linasplit[2])!!,
                    Double.valueOf(linasplit[3])!!, linasplit[4], linasplit[5], linasplit[6])
            ltsis.add(sismo)
            println(sismo)
            linea = bufferedReader.readLine()
        }
        listaSismo = ListaSismos(ltsis)
        bufferedReader.close()
    } catch (e: Exception) {
        println("Error inesperado en: " + e.toString())
    }
}
