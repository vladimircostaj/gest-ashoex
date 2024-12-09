const API_URL = "http://127.0.0.1:8000"; 

const fetchMaterias = async () => {
  const response = await fetch(`${API_URL}/api/materias`, 
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  ); 
  const data = await response.json(); 
  
  return data;
};

const deleteMateria = async (id) => {
  try {
    const response = await fetch(`${API_URL}/api/materias/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const data = await response.json();

    if (data.success === false) {
      throw new Error("Error al eliminar la materia");
    }

    return data;

  } catch (error) {
    throw error;
  }
};

const materiaService = {
  fetchMaterias,
  deleteMateria,
};

export default materiaService;

const BASE_URL = "http://localhost:8000/api/materias";

export const createMateria = async (materiaData) => {
  try {
    const response = await fetch(BASE_URL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(materiaData),
    });

    const result = await response.json();
    return result;
  } catch (error) {
    return error;
  }
};
