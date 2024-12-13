const API_BASE_URL = "http://localhost:8000/api";

const fetchCarreraStatus = async () => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras`);

      if (!response.ok) {
         if (response.status === 404) {
            throw new Error("No se encontraron carreras. Por favor, agrega una carrera.");
         } else {
            throw new Error(`${response.status} ${response.statusText}`);
         }
      }

      const data = await response.json();

      if (!data.success) {
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data;
   } catch (error) {
      console.error("Error al obtener las carreras:", error.message);
      throw error;
   }
};

const fetchCarreraById = async (id) => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras/${id}`);

      if (!response.ok) {
         throw new Error(`Error ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();

      if (!data.success) {
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data;
   } catch (error) {
      console.error(`Error al obtener la carrera con ID ${id}:`, error.message);
      throw error;
   }
};

const updateCarrera = async (id, updatedData) => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras/${id}`, {
         method: "PUT",
         headers: {
            "Content-Type": "application/json",
         },
         body: JSON.stringify(updatedData),
      });

      if (!response.ok) {
         throw new Error(`Error ${response.status}: ${response.statusText}`);
      }

      const data = await response.json();

      if (!data.success) {
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data;
   } catch (error) {
      console.error(`Error al actualizar la carrera con ID ${id}:`, error.message);
      throw error;
   }
};

// Agrega la función de eliminación a los servicios
const deleteCarrera = async (id) => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras/${id}`, {
         method: 'DELETE',
         headers: {
            'Content-Type': 'application/json'
         }
      });
      if (!response.ok) {
         throw new Error('Error al eliminar la carrera');
      }
   } catch (error) {
      throw error;
   }
};

const carrerasService = {
   fetchCarreraStatus,
   fetchCarreraById,
   updateCarrera,
   deleteCarrera // <-- Nueva función de eliminación añadida
};

export default carrerasService;