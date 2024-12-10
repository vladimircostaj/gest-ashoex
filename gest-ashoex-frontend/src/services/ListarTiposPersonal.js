import axios from "axios";

const API_BASE_URL = "http://localhost:8000/api";

/**
 * Servicio para obtener la lista de tipos de personal.
 * @returns {Promise<Array>} Lista de tipos de personal en formato [{ id, nombre }]
 * @throws {Error} Si ocurre algún error en la solicitud.
 */
export const listarTiposPersonal = async () => {
  try {
    const response = await axios.get(`${API_BASE_URL}/tipos-personal`);
    if (response.data && response.data.success) {
      return response.data.data; // Asume que los datos de tipos están en `data`
    } else {
      throw new Error(response.data.message || "Error desconocido al listar tipos.");
    }
  } catch (error) {
    if (error.response) {
      // Error de respuesta del servidor
      throw new Error(error.response.data.message || "Error al obtener tipos de personal.");
    }
    throw new Error("Error de conexión con el servidor.");
  }
};
