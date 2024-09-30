import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";

const InformacionPersonalAcademico = () => {
  const { id } = useParams();
  const [user, setUser] = useState(null); // Cambia a null para manejar mejor la carga
  const [loading, setLoading] = useState(true); // Estado para manejar la carga
  const [error, setError] = useState(null); // Estado para manejar errores

  useEffect(() => {
    getUsuario();
  }, []);

  const getUsuario = async () => {
    try {
      const respuesta = await fetch(`http://localhost:8000/api/personal/${id}/informacion`);
      
      if (!respuesta.ok) {
        throw new Error('Error al obtener la información del usuario');
      }

      const data = await respuesta.json();
      setUser(data); // Asumiendo que la respuesta es el objeto del usuario
    } catch (error) {
      console.error("Error al obtener la información del usuario:", error);
      setError(error.message); // Guardar el mensaje de error
    } finally {
      setLoading(false); // Termina el estado de carga
    }
  };

  if (loading) {
    return <p>Cargando...</p>; // Mensaje de carga
  }

  if (error) {
    return <p>Error: {error}</p>; // Mensaje de error
  }

  return (
    <section
      style={{
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        height: "100vh",
        backgroundColor: "#f5f5f5",
      }}
    >
      <div
        style={{
          backgroundColor: "#fff",
          padding: "40px",
          borderRadius: "10px",
          boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
          maxWidth: "800px",
          width: "100%",
          textAlign: "center",
        }}
      >
        <img
          src={user.avatar || 'https://via.placeholder.com/150'} // Usa un placeholder si no hay avatar
          alt={`${user.name}'s avatar`}
          style={{
            width: "150px",
            height: "150px",
            borderRadius: "50%",
            marginBottom: "20px",
          }}
        />

        <div style={{ marginTop: "20px" }}>
          <p style={{ margin: "5px 0", color: "#666", fontSize: "18px" }}>
            <strong>Nombre:</strong> {user.name}
          </p>
        </div>

        <div style={{ marginTop: "20px" }}>
          <p style={{ margin: "5px 0", color: "#666", fontSize: "18px" }}>
            <strong>Correo:</strong> {user.email}
          </p>
        </div>

        <div style={{ marginTop: "20px" }}>
          <p style={{ margin: "5px 0", color: "#666", fontSize: "18px" }}>
            <strong>Telefono:</strong> {user.telefono}
          </p>
        </div>

        <div style={{ marginTop: "20px" }}>
          <p style={{ margin: "5px 0", color: "#666", fontSize: "18px" }}>
            <strong>Estado:</strong> {user.estado}
          </p>
        </div>

        <div style={{ marginTop: "20px" }}>
          <p style={{ margin: "5px 0", color: "#666", fontSize: "18px" }}>
            <strong>Tipo de Personal:</strong> {user.tipo_personal}
          </p>
        </div>
      </div>
    </section>
  );
};

export default InformacionPersonalAcademico;
