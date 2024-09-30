import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import { obtenerUsuario } from "../../services/registrar_personal_api";
const InformacionPersonalAcademico = () => {
  const { id } = useParams();
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchUsuario = async () => {
      try {
        const data = await obtenerUsuario(id);
        setUser(data);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchUsuario();
  }, [id]);

  if (loading) {
    return <p>Cargando...</p>;
  }

  if (error) {
    return <p>Error: {error}</p>;
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
          src={user.avatar || 'https://via.placeholder.com/150'}
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
            <strong>Tipo de Personal:</strong> {user.tipo_personal?.nombre}
          </p>
        </div>
      </div>
    </section>
  );
};

export default InformacionPersonalAcademico;
