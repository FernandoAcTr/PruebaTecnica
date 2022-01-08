create database Prueba;
use Prueba;

create table Producto
(
    id_producto int auto_increment primary key,
    clave_producto varchar(10)   not null,
    nombre         varchar(50)   not null,
    precio         decimal(19, 2) not null,
    constraint uq_cve unique (clave_producto)
);

DELIMITER $$
create procedure store_product(
    IN p_clave varchar(10),
    IN p_nombre varchar(50),
    IN p_precio decimal(19,2)
)
begin
    IF (select count(*) from Producto where clave_producto = p_clave) = 0 THEN
        insert into Producto(clave_producto, nombre, precio) values (p_clave, p_nombre, p_precio);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Clave de Producto duplicada';
    END IF;
end
$$ DELIMITER ;


