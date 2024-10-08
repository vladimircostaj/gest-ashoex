const ListaPersonalAcademico = async () => {
    const response = await fetch('http://localhost:8000/api/ListaPersonalAcademico');
    if (!response.ok) {
        throw new Error('Error al obtener los datos');
    }
    return await response.json();
};

export default ListaPersonalAcademico;