package com.luistoro.proyecto_sismos

import Operaciones.ListaSismos
import Operaciones.Sismo
import android.app.Fragment
import android.content.Intent
import android.graphics.Region
import android.support.v7.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.ArrayAdapter
import android.widget.Spinner
import android.widget.TextView
import java.io.BufferedReader
import java.io.InputStreamReader
import java.util.*

class Estadistica : AppCompatActivity() {
    private var ltsis = LinkedList<Sismo>()
    private var listaSismo: ListaSismos = ListaSismos(ltsis)

    override fun onCreate(savedInstanceState: Bundle?) {
        cargarDatos()
        super.onCreate(savedInstanceState)
        setContentView(R.layout.estadistica)
        val regiones = findViewById<Spinner>(R.id.regiones)
        val lista = arrayOf("Costa", "Sierra", "Oriente", "Insular")
        val bt4 = findViewById<View>(R.id.button4)
        val bt3 = findViewById<View>(R.id.button3)
        val adaptador1 = ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, lista)
        regiones.adapter = adaptador1
        bt4.setOnClickListener{
            val intento2 = Intent(this,Main::class.java)
            startActivity(intento2)}
        bt3.setOnClickListener{
            mostrarEstadistica(regiones)
        }
    }

    fun mostrarEstadistica(region: Spinner){
        var textview = findViewById<TextView>(R.id.vistaesta)
        when (region.selectedItem.toString()) {
            "Costa" -> textview.text = "Promedio de grado de sismos : ${sacarEstadistica(this.listaSismo,"costa")}"
            "Sierra" -> textview.text = "Promedio de grado de sismos : ${sacarEstadistica(this.listaSismo,"sierra")}"
            "Oriente" -> textview.text ="Promedio de grado de sismos : ${sacarEstadistica(this.listaSismo,"amazonia")}"
            "Insular" -> textview.text ="Promedio de grado de sismos : ${sacarEstadistica(this.listaSismo,"insular")}"
        }
    }

    fun sacarEstadistica(lista: ListaSismos,region: String): String {
        var promedio = 0.0
        var veces = 0
        var mayor= 0.0;
        var menor = Double.MAX_VALUE
        for(i in lista.listaSismos){
            if(i.region.equals(region)){
                promedio += Math.pow(10.0,i.grado)
                veces++
                if(i.grado >= mayor){
                    mayor = i.grado
                }
                if(i.grado<= menor){
                    menor = i.grado
                }
            }
        }
        if(veces == 0){
            return "No se han encontrado sismos registrados"
        }
        var total =promedio/veces
        return String.format("%.2f",(Math.log10(total))) +"\n" + "Numero de sismos registrados en la region : ${veces}" +
                "\n" + "\n" + "Grado de mayor sismo registrado: "+String.format("%.2f",mayor) +"\n" +"Grado de menor sismo registrado: "+String.format("%.2f",menor)
    }

    fun cargarDatos() = try {
        val fileReader = this.resources.openRawResource(R.raw.markers)
        val bufferedReader = BufferedReader(InputStreamReader(fileReader))
        var linea: String? = bufferedReader.readLine()
        while (linea != null) {
            val linasplit = linea.split(";".toRegex()).dropLastWhile { it.isEmpty() }.toTypedArray()
            val sismo = Sismo(java.lang.Double.valueOf(linasplit[0])!!, java.lang.Double.valueOf(linasplit[1])!!, java.lang.Double.valueOf(linasplit[2])!!,
                    java.lang.Double.valueOf(linasplit[3])!!, linasplit[4], linasplit[5], linasplit[6])
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
