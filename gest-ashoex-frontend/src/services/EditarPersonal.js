import axios from "axios";

const API_BASE_URL = "http://localhost:8000/api";

// Obtener un registro de personal académico por ID
export const getPersonalById = async (id) => {
  try {
    const response = await axios.get(`${API_BASE_URL}/personal-academicos/${id}`);
    return response.data;
  } catch (error) {
    console.error("Error al obtener los datos del personal académico", error);
    throw error;
  }
};

// Actualizar un registro de personal académico
export const updatePersonal = async (id, personalData) => {
  try {
    const response = await axios.put(`${API_BASE_URL}/personal-academicos/${id}`, personalData);
    return response.data;
  } catch (error) {
    console.error("Error al actualizar los datos del personal académico", error);
    throw error;
  }
};
