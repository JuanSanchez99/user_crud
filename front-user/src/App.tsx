import React, { useState, useEffect } from "react";
import { useForm, Resolver } from "react-hook-form";
import "./App.css";

interface User {
  id: number;
  number_id: string;
  name: string;
  lastname: string;
  email: string;
  country: string;
  address: string;
  phone: number;
  category_id: number;
  created_at: Date;
  updated_at: Date;
}

type FormValues = {
  name: string;
  lastname: string;
  email: string;
  number_id: string;
  country: string;
  address: string;
  phone: string;
  category_id: number;
};

function App() {
  const [users, setUsers] = useState(Array<User>);
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<FormValues>();
  const onSubmit = handleSubmit((data) => {
    fetch("http://localhost:8000/api/customers", {
      method: "POST",
      body: JSON.stringify(data),
    });
  });

  const removeUser = async (id: number) => {
    await fetch(`http://localhost:8000/api/customers/${id}`);
    setUsers((current) => current.filter((user) => user.id !== id));
  };

  useEffect(() => {
    const fetchUsers = async () => {
      const res = await fetch("http://localhost:8000/api/customers");
      const users_response = await res.json();
      setUsers(users_response);
    };
    // const fetchCountries = async () => {
    //   const res = await fetch(
    //     "https://api.first.org/data/v1/countries?region=South%20America",
    //     {
    //       mode: "same-origin",
    //       headers: {
    //         'Content-Type': 'application/json'
    //       },
    //     }
    //   );
    //   const users_response = await res.json;
    //   console.log(res);
    // };

    // fetchCountries();
    fetchUsers();
  }, []);
  return (
    <div className="App">
      <h1>User CRUD</h1>
      <h2>Nuevo Usuario</h2>
      <form onSubmit={onSubmit}>
        <input {...register("name")} placeholder="name" />
        <input {...register("lastname")} placeholder="lastname" />
        <input {...register("email")} placeholder="email" />
        <input {...register("number_id")} placeholder="numberId" />
        <input {...register("country")} placeholder="country" />
        <input {...register("address")} placeholder="address" />
        <input {...register("phone")} placeholder="phone" />
        <input {...register("category_id")} placeholder="category_id" />
        <input type="submit" />
      </form>
      <h2>Tarjetas de usuarios</h2>
      <div>
        {users.map((user) => {
          return (
            <div key={user.id}>
              <h3>
                {user.name} {user.lastname}
              </h3>
              <p>{user.number_id}</p>
              <p>{user.email}</p>
              <p>{user.country}</p>
              <p>{user.address}</p>
              <p>{user.phone}</p>
              <button
                onClick={() => {
                  removeUser(user.id);
                }}
              >
                Eliminar
              </button>
            </div>
          );
        })}
      </div>
    </div>
  );
}

export default App;
