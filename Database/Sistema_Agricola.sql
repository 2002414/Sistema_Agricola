--
-- PostgreSQL database dump
--

\restrict YvyY3LvCYOB45H0zeQI3Gc7Tg4hcwFicRMutb1AkdNlH5rEdhWopmjVUprHd9fn

-- Dumped from database version 18.0
-- Dumped by pg_dump version 18.0

-- Started on 2026-05-20 23:47:39

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 232 (class 1259 OID 16622)
-- Name: calificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.calificaciones (
    id_calificacion integer NOT NULL,
    id_producto integer,
    id_usuario integer,
    puntuacion integer,
    comentario text,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_pedido integer,
    productor character varying(100),
    comprador character varying(100),
    estrellas integer,
    CONSTRAINT calificaciones_puntuacion_check CHECK (((puntuacion >= 1) AND (puntuacion <= 5)))
);


ALTER TABLE public.calificaciones OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 16621)
-- Name: calificaciones_id_calificacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.calificaciones_id_calificacion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.calificaciones_id_calificacion_seq OWNER TO postgres;

--
-- TOC entry 5104 (class 0 OID 0)
-- Dependencies: 231
-- Name: calificaciones_id_calificacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.calificaciones_id_calificacion_seq OWNED BY public.calificaciones.id_calificacion;


--
-- TOC entry 226 (class 1259 OID 16566)
-- Name: detalle_pedido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.detalle_pedido (
    id_detalle integer NOT NULL,
    id_pedido integer,
    id_producto integer,
    cantidad integer NOT NULL,
    subtotal numeric(10,2)
);


ALTER TABLE public.detalle_pedido OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16565)
-- Name: detalle_pedido_id_detalle_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.detalle_pedido_id_detalle_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.detalle_pedido_id_detalle_seq OWNER TO postgres;

--
-- TOC entry 5105 (class 0 OID 0)
-- Dependencies: 225
-- Name: detalle_pedido_id_detalle_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.detalle_pedido_id_detalle_seq OWNED BY public.detalle_pedido.id_detalle;


--
-- TOC entry 228 (class 1259 OID 16585)
-- Name: entregas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.entregas (
    id_entrega integer NOT NULL,
    id_pedido integer,
    estado character varying(50),
    fecha_entrega date,
    observaciones text
);


ALTER TABLE public.entregas OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 16584)
-- Name: entregas_id_entrega_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.entregas_id_entrega_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.entregas_id_entrega_seq OWNER TO postgres;

--
-- TOC entry 5106 (class 0 OID 0)
-- Dependencies: 227
-- Name: entregas_id_entrega_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.entregas_id_entrega_seq OWNED BY public.entregas.id_entrega;


--
-- TOC entry 234 (class 1259 OID 16644)
-- Name: historial_actividades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.historial_actividades (
    id_historial integer NOT NULL,
    usuario character varying(100),
    accion text,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.historial_actividades OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 16643)
-- Name: historial_actividades_id_historial_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.historial_actividades_id_historial_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.historial_actividades_id_historial_seq OWNER TO postgres;

--
-- TOC entry 5107 (class 0 OID 0)
-- Dependencies: 233
-- Name: historial_actividades_id_historial_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.historial_actividades_id_historial_seq OWNED BY public.historial_actividades.id_historial;


--
-- TOC entry 230 (class 1259 OID 16600)
-- Name: mensajes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mensajes (
    id_mensaje integer NOT NULL,
    emisor integer,
    receptor integer,
    mensaje text NOT NULL,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.mensajes OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 16599)
-- Name: mensajes_id_mensaje_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mensajes_id_mensaje_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mensajes_id_mensaje_seq OWNER TO postgres;

--
-- TOC entry 5108 (class 0 OID 0)
-- Dependencies: 229
-- Name: mensajes_id_mensaje_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mensajes_id_mensaje_seq OWNED BY public.mensajes.id_mensaje;


--
-- TOC entry 224 (class 1259 OID 16551)
-- Name: pedidos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pedidos (
    id_pedido integer NOT NULL,
    id_usuario integer,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(50) DEFAULT 'pendiente'::character varying,
    total numeric(10,2)
);


ALTER TABLE public.pedidos OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16550)
-- Name: pedidos_id_pedido_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pedidos_id_pedido_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.pedidos_id_pedido_seq OWNER TO postgres;

--
-- TOC entry 5109 (class 0 OID 0)
-- Dependencies: 223
-- Name: pedidos_id_pedido_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pedidos_id_pedido_seq OWNED BY public.pedidos.id_pedido;


--
-- TOC entry 222 (class 1259 OID 16531)
-- Name: productos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.productos (
    id_producto integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion text,
    precio numeric(10,2) NOT NULL,
    stock integer NOT NULL,
    imagen character varying(255),
    categoria character varying(100),
    estado boolean DEFAULT true,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    id_usuario integer
);


ALTER TABLE public.productos OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16530)
-- Name: productos_id_producto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.productos_id_producto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.productos_id_producto_seq OWNER TO postgres;

--
-- TOC entry 5110 (class 0 OID 0)
-- Dependencies: 221
-- Name: productos_id_producto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.productos_id_producto_seq OWNED BY public.productos.id_producto;


--
-- TOC entry 220 (class 1259 OID 16510)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario integer NOT NULL,
    nombre character varying(100) NOT NULL,
    correo character varying(100),
    password character varying(255),
    rol character varying(50) NOT NULL,
    telefono character varying(20),
    direccion text,
    estado boolean DEFAULT true,
    fecha_registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    dpi character varying(30),
    codigo_mensaje character varying(50)
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16509)
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 5111 (class 0 OID 0)
-- Dependencies: 219
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_usuario_seq OWNED BY public.usuarios.id_usuario;


--
-- TOC entry 4904 (class 2604 OID 16625)
-- Name: calificaciones id_calificacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones ALTER COLUMN id_calificacion SET DEFAULT nextval('public.calificaciones_id_calificacion_seq'::regclass);


--
-- TOC entry 4900 (class 2604 OID 16569)
-- Name: detalle_pedido id_detalle; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_pedido ALTER COLUMN id_detalle SET DEFAULT nextval('public.detalle_pedido_id_detalle_seq'::regclass);


--
-- TOC entry 4901 (class 2604 OID 16588)
-- Name: entregas id_entrega; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregas ALTER COLUMN id_entrega SET DEFAULT nextval('public.entregas_id_entrega_seq'::regclass);


--
-- TOC entry 4906 (class 2604 OID 16647)
-- Name: historial_actividades id_historial; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historial_actividades ALTER COLUMN id_historial SET DEFAULT nextval('public.historial_actividades_id_historial_seq'::regclass);


--
-- TOC entry 4902 (class 2604 OID 16603)
-- Name: mensajes id_mensaje; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensajes ALTER COLUMN id_mensaje SET DEFAULT nextval('public.mensajes_id_mensaje_seq'::regclass);


--
-- TOC entry 4897 (class 2604 OID 16554)
-- Name: pedidos id_pedido; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedidos ALTER COLUMN id_pedido SET DEFAULT nextval('public.pedidos_id_pedido_seq'::regclass);


--
-- TOC entry 4894 (class 2604 OID 16534)
-- Name: productos id_producto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos ALTER COLUMN id_producto SET DEFAULT nextval('public.productos_id_producto_seq'::regclass);


--
-- TOC entry 4891 (class 2604 OID 16513)
-- Name: usuarios id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuarios_id_usuario_seq'::regclass);


--
-- TOC entry 5096 (class 0 OID 16622)
-- Dependencies: 232
-- Data for Name: calificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.calificaciones (id_calificacion, id_producto, id_usuario, puntuacion, comentario, fecha, id_pedido, productor, comprador, estrellas) FROM stdin;
1	\N	\N	\N	Me gusto el producto y de buena calidad	2026-05-20 22:45:56.995857	1	Productor	Comprador	5
\.


--
-- TOC entry 5090 (class 0 OID 16566)
-- Dependencies: 226
-- Data for Name: detalle_pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.detalle_pedido (id_detalle, id_pedido, id_producto, cantidad, subtotal) FROM stdin;
\.


--
-- TOC entry 5092 (class 0 OID 16585)
-- Dependencies: 228
-- Data for Name: entregas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.entregas (id_entrega, id_pedido, estado, fecha_entrega, observaciones) FROM stdin;
\.


--
-- TOC entry 5098 (class 0 OID 16644)
-- Dependencies: 234
-- Data for Name: historial_actividades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.historial_actividades (id_historial, usuario, accion, fecha) FROM stdin;
1	Julissa Silva	Inicio de sesión	2026-05-18 20:54:04.754621
2	Julissa Silva	Creó producto: Tomate	2026-05-19 22:18:36.717488
3	Julissa Silva	Creó producto: Café Orgánico	2026-05-19 22:20:17.700712
4	Julissa Silva	Creó producto: Maíz	2026-05-19 22:22:01.616793
5	Comprador	Envió un mensaje	2026-05-20 20:37:00.058899
6	Comprador	Envió un mensaje	2026-05-20 21:51:47.703024
\.


--
-- TOC entry 5094 (class 0 OID 16600)
-- Dependencies: 230
-- Data for Name: mensajes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mensajes (id_mensaje, emisor, receptor, mensaje, fecha) FROM stdin;
1	10	3	Hola, esto es una prueba	2026-05-20 20:37:00.051518
2	10	2	Hola	2026-05-20 21:51:47.700991
\.


--
-- TOC entry 5088 (class 0 OID 16551)
-- Dependencies: 224
-- Data for Name: pedidos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pedidos (id_pedido, id_usuario, fecha, estado, total) FROM stdin;
\.


--
-- TOC entry 5086 (class 0 OID 16531)
-- Dependencies: 222
-- Data for Name: productos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.productos (id_producto, nombre, descripcion, precio, stock, imagen, categoria, estado, fecha_creacion, id_usuario) FROM stdin;
2	Café Orgánico	Café orgánico de altura producido por agricultores locales	75.00	50	cafe.jpg	Granos	t	2026-05-19 22:20:17.696005	\N
3	Maíz	Maíz amarillo natural cosechado en temporada	40.00	80	maiz.jpg	Cereales	t	2026-05-19 22:22:01.612176	\N
1	Tomate	Tomate fresco cultivado en la Comunidad La Esperanza	25.00	100	Tomate.jpg	Vegetales	t	2026-05-19 22:18:36.709172	\N
\.


--
-- TOC entry 5084 (class 0 OID 16510)
-- Dependencies: 220
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id_usuario, nombre, correo, password, rol, telefono, direccion, estado, fecha_registro, dpi, codigo_mensaje) FROM stdin;
2	Administrador	admin2@gmail.com	$2y$10$mLq3lhDVyPxQeZH4p0mcQ.o4LvdCp63Rkm1b/fvqXmPeyHf0pkfAW	admin	55550001	\N	t	2026-05-18 20:34:47.45845	\N	\N
3	Julissa Silva	producto@gmail.com	$2y$10$xmF5.oQh/zxXQbf6j6oa6ueygMnRQS9O/aTlmOGOwI.zykWmEFmy2	productor	55550002	\N	t	2026-05-18 20:41:44.42238	1234567890101	AGRO2025
10	Comprador	\N	\N	comprador	55550002	\N	t	2026-05-20 20:26:53.312846		
\.


--
-- TOC entry 5112 (class 0 OID 0)
-- Dependencies: 231
-- Name: calificaciones_id_calificacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.calificaciones_id_calificacion_seq', 1, true);


--
-- TOC entry 5113 (class 0 OID 0)
-- Dependencies: 225
-- Name: detalle_pedido_id_detalle_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.detalle_pedido_id_detalle_seq', 1, false);


--
-- TOC entry 5114 (class 0 OID 0)
-- Dependencies: 227
-- Name: entregas_id_entrega_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.entregas_id_entrega_seq', 13, true);


--
-- TOC entry 5115 (class 0 OID 0)
-- Dependencies: 233
-- Name: historial_actividades_id_historial_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.historial_actividades_id_historial_seq', 6, true);


--
-- TOC entry 5116 (class 0 OID 0)
-- Dependencies: 229
-- Name: mensajes_id_mensaje_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mensajes_id_mensaje_seq', 2, true);


--
-- TOC entry 5117 (class 0 OID 0)
-- Dependencies: 223
-- Name: pedidos_id_pedido_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pedidos_id_pedido_seq', 1, true);


--
-- TOC entry 5118 (class 0 OID 0)
-- Dependencies: 221
-- Name: productos_id_producto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.productos_id_producto_seq', 3, true);


--
-- TOC entry 5119 (class 0 OID 0)
-- Dependencies: 219
-- Name: usuarios_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_usuario_seq', 10, true);


--
-- TOC entry 4924 (class 2606 OID 16632)
-- Name: calificaciones calificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones
    ADD CONSTRAINT calificaciones_pkey PRIMARY KEY (id_calificacion);


--
-- TOC entry 4918 (class 2606 OID 16573)
-- Name: detalle_pedido detalle_pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT detalle_pedido_pkey PRIMARY KEY (id_detalle);


--
-- TOC entry 4920 (class 2606 OID 16593)
-- Name: entregas entregas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregas
    ADD CONSTRAINT entregas_pkey PRIMARY KEY (id_entrega);


--
-- TOC entry 4926 (class 2606 OID 16653)
-- Name: historial_actividades historial_actividades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.historial_actividades
    ADD CONSTRAINT historial_actividades_pkey PRIMARY KEY (id_historial);


--
-- TOC entry 4922 (class 2606 OID 16610)
-- Name: mensajes mensajes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensajes
    ADD CONSTRAINT mensajes_pkey PRIMARY KEY (id_mensaje);


--
-- TOC entry 4916 (class 2606 OID 16559)
-- Name: pedidos pedidos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id_pedido);


--
-- TOC entry 4914 (class 2606 OID 16544)
-- Name: productos productos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT productos_pkey PRIMARY KEY (id_producto);


--
-- TOC entry 4910 (class 2606 OID 16526)
-- Name: usuarios usuarios_correo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);


--
-- TOC entry 4912 (class 2606 OID 16524)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id_usuario);


--
-- TOC entry 4934 (class 2606 OID 16633)
-- Name: calificaciones fk_calificacion_producto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones
    ADD CONSTRAINT fk_calificacion_producto FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);


--
-- TOC entry 4935 (class 2606 OID 16638)
-- Name: calificaciones fk_calificacion_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones
    ADD CONSTRAINT fk_calificacion_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);


--
-- TOC entry 4929 (class 2606 OID 16574)
-- Name: detalle_pedido fk_detalle_pedido; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT fk_detalle_pedido FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id_pedido);


--
-- TOC entry 4930 (class 2606 OID 16579)
-- Name: detalle_pedido fk_detalle_producto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detalle_pedido
    ADD CONSTRAINT fk_detalle_producto FOREIGN KEY (id_producto) REFERENCES public.productos(id_producto);


--
-- TOC entry 4932 (class 2606 OID 16611)
-- Name: mensajes fk_emisor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensajes
    ADD CONSTRAINT fk_emisor FOREIGN KEY (emisor) REFERENCES public.usuarios(id_usuario);


--
-- TOC entry 4931 (class 2606 OID 16594)
-- Name: entregas fk_entrega_pedido; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.entregas
    ADD CONSTRAINT fk_entrega_pedido FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id_pedido);


--
-- TOC entry 4928 (class 2606 OID 16560)
-- Name: pedidos fk_pedido_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT fk_pedido_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);


--
-- TOC entry 4927 (class 2606 OID 16545)
-- Name: productos fk_producto_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.productos
    ADD CONSTRAINT fk_producto_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id_usuario);


--
-- TOC entry 4933 (class 2606 OID 16616)
-- Name: mensajes fk_receptor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mensajes
    ADD CONSTRAINT fk_receptor FOREIGN KEY (receptor) REFERENCES public.usuarios(id_usuario);


-- Completed on 2026-05-20 23:47:39

--
-- PostgreSQL database dump complete
--

\unrestrict YvyY3LvCYOB45H0zeQI3Gc7Tg4hcwFicRMutb1AkdNlH5rEdhWopmjVUprHd9fn

