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
  const fetchMateriaById = async (id) => {
    const response = await fetch(`${API_URL}/api/materias/${id}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    
    if (!response.ok) {
      throw new Error('No se pudo cargar la materia');
    }
    
    const data = await response.json();
    return data;
  };
  const updateMateria = async (id, materiaData) => {
    const response = await fetch(`${API_URL}/api/materias/${id}`, {
      method: "PUT", 
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(materiaData), 
    });
    
    if (!response.ok) {
      throw new Error('No se pudo actualizar la materia');
    }
    
    const data = await response.json();
    return data; 
  };
  const deleteMateria = async (id) => {
    const response = await fetch(`${API_URL}/api/materias/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });
    
    if (!response.ok) {
      throw new Error('No se pudo eliminar la materia');
    }
  
    return response.json();
  };
  const materiaService = {
    fetchMaterias,
    fetchMateriaById,
    updateMateria,
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
