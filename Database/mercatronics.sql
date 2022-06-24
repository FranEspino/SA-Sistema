
create database mercatronics;

CREATE TABLE usuario(
id_usuario INT NOT NULL AUTO_INCREMENT,
nombre_usuario VARCHAR(50),
clave_usuario VARCHAR(50),
CONSTRAINT pk_usuario PRIMARY KEY(id_usuario)
)



CREATE TABLE trabajador(
id_trabajador INT NOT NULL AUTO_INCREMENT,
id_usario INT,
nombre_trabajador VARCHAR(40),
dni_trabajador  CHAR(8),
correo_trabajador VARCHAR(20),
sexo_trabajador CHAR(1),
tipo_trabajador VARCHAR(25),
direccion_trabajador VARCHAR(30),
CONSTRAINT fk_usuariotrab   FOREIGN KEY(id_usario) REFERENCES usuario(id_usuario),
CONSTRAINT pk_trabajador PRIMARY KEY(id_trabajador)
);


CREATE TABLE producto(
id_producto INT NOT NULL AUTO_INCREMENT,
nombre_producto VARCHAR(50),
modelo_producto VARCHAR	(40),
precio_producto FLOAT,
stock_producto INT,
descripcion_producto VARCHAR(150),
CONSTRAINT pk_producto PRIMARY KEY(id_producto)
);

CREATE TABLE cliente(
id_cliente INT NOT NULL AUTO_INCREMENT,
nombre_cliente VARCHAR(40),
dni_cliente CHAR(8),
correo_cliente VARCHAR(40),
CONSTRAINT pk_cliente PRIMARY KEY(id_cliente)
);

CREATE TABLE venta(
id_venta INT NOT NULL AUTO_INCREMENT,
id_cliente INT NOT NULL,
id_trabajador INT NOT NULL,
fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP  
ON UPDATE CURRENT_TIMESTAMP,
CONSTRAINT pk_venta PRIMARY KEY(id_venta),
CONSTRAINT fk_ventacliente FOREIGN KEY(id_cliente) REFERENCES cliente(id_cliente),
CONSTRAINT fk_empleadoventa FOREIGN KEY(id_trabajador) REFERENCES trabajador(id_trabajador)
);



CREATE TABLE detalle_venta (
id_venta INT NOT NULL,
id_producto INT NOT NULL,
precio_producto FLOAT,
cantidad_venta INT,
descuento FLOAT,
CONSTRAINT fk_detallventa FOREIGN KEY(id_venta) REFERENCES venta(id_venta),
CONSTRAINT fk_detallproducto FOREIGN KEY(id_producto) REFERENCES producto(id_producto)
)