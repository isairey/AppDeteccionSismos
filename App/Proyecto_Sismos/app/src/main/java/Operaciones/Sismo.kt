package Operaciones

import java.util.*

/**
 * Created by Luis Toro on 3/9/2017.
 */

data class ListaSismos (var listaSismos: LinkedList<Sismo>) {
    init{
        this.listaSismos =listaSismos
    }
}
class Sismo(lat: Double, lng: Double, grado: Double, prof: Double, ubicacion: String, region: String, var fecha: String?) {
    var lat = 0.0
    var lng = 0.0
    var prof = 0.0
    var grado = 0.0
    var region = ""
    var ubicacion = ""

    init {
        this.lat = lat
        this.lng = lng
        this.prof = prof
        this.grado = grado
        this.region = region
        this.ubicacion = ubicacion
    }
}
