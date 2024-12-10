import axios from 'axios'; 


export const getPersonalById = async (id) => {
    const response = await fetch(
      `http://localhost:8000/api/personal-academicos/${id}`
    );
    return await response.json();
  };

// services/ListaPersonalService.js

export const darBaja = async (id) => {
  try {
    const response = await fetch(
      `http://localhost:8000/api/personal-academicos/${id}/dar-baja`, // Corregir la URL
      {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
        },
      }
    );

    const data = await response.json();
    
    if (response.ok) {
      return { success: true, data };
    } else {
      return { success: false, message: data.message || 'Error al dar de baja.' };
    }
  } catch (error) {
    console.error('Error al dar de baja:', error);
    return { success: false, message: 'Ocurrió un error en el servidor.' };
  }
};

//reactivar
export const reactivarPersonal = async (id) => {
  try {
    const response = await fetch(`http://localhost:8000/api/personal-academicos/${id}/reactivar`, {
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ estado: "ACTIVO" }), 
    });
    
    if (!response.ok) {
      throw new Error(`Error al reactivar el usuario. Status: ${response.status}`);
    }
    return response.json();
  } catch (error) {
    console.error("Error al reactivar el personal:", error);
    throw error;
  }
};


//eliminar
export const eliminarPersonal = async (id) => {
  try {
    const response = await axios.delete(`http://localhost:8000/api/personal-academicos/${id}`);
    return response;
  } catch (error) {
    throw error;
  }
};