import requests
import sys
import re
latitud = "lat\=\"(\-?[0-9]+\.[0-9]+)\""
longitud = "lng\=\"(\-?[0-9]+\.[0-9]+)\""
magnitud = "mg\=\"([0-9\.]+)\""
profundidad = "localizacion\=\"([0-9]+\.[0-9]+)"
localizacion = "(\s[\s a-z A-Z]+\,[A-Za-z\s]+)\""
marker = "(\<.*\/\>)"
fecha = 'fecha\=\"([0-9]{4}\/[0-9]{2}\/[0-9]{2}\s[0-9]{2}\:[0-9]{2}\:[0-9]{2})\"'
costa = '(Guayas)|(Manabi)|(Sta Elena)|(Esmeraldas)|(El Oro)|(Los Rios)'
sierra = '(Azuay)|(Bolivar)|(Cañar)|(Canar)|(Carchi)|(Chimborazo)|(Cotopaxi)|(Imbabura)|(Loja)|(Pichincha)|(Tungurahua)|(Sto Dom Tsachilas)'
amazonia = "(Sucumbios)|(Napo)|(Fco de Orellana)|(Fco Orellana)|(Pastaza)|(Morona Stgo)|(Zamora Chinchipe)"
lista = []
linea = []

def descargarWeb(url):
    r = requests.get(url)
    if r.status_code != 200:
        sys.stderr.write("! Error {} retrieving url {}".format(r.status_code, url))
        return None

    return r.text

url = "http://www.igepn.edu.ec/portal/ultimo-sismo/events.xml"
r = descargarWeb(url)

resp = re.findall(marker,str(r))
for i in resp:
    band = re.search(latitud, i)
    if band != None:
        patron = re.compile(latitud)
        linea.append(patron.split(i)[1])
    else:
        linea.append("NO")
    linea.append(";")
    band = re.search(longitud, i)
    if band != None:
        patron = re.compile(longitud)
        linea.append(patron.split(i)[1])
    else:
        linea.append("NO")
    linea.append(";")

    band = re.search(magnitud, i)
    if band != None:
        patron = re.compile(magnitud)
        linea.append(patron.split(i)[1])
    else:
        linea.append("NO")
    linea.append(";")

    band = re.search(profundidad, i)
    if band != None:
        patron = re.compile(profundidad)
        linea.append(patron.split(i)[1])
    else:
        linea.append("NO")
    linea.append(";")

    band = re.search(localizacion, i)
    analizar = ""
    if band != None:
        patron = re.compile(localizacion)
        analizar = patron.split(i)[1]
        linea.append(analizar)
    else:
        linea.append("NO")

    array = analizar.split(",")

    band = re.match(costa, array[1])
    if band != None:
        linea.append(";costa;")
    else:
        band = re.match(sierra, array[1])
        if band != None:
            linea.append(";sierra;")
        else:
            linea.append(";amazonia;")
    band = re.search(fecha, i)
    if band != None:
        patron = re.compile(fecha)
        linea.append(patron.split(i)[1])
    else:
        linea.append("NO")
    linea.append(";")
    lista.append(linea)
    linea = []

archivoUsuarios = open("markers.txt", "w")
for k in lista:
    for z in k:
        archivoUsuarios.write(z)
    archivoUsuarios.write("\n")