// File: src/routes/AdminRoutes.jsx
import { Routes, Route, Navigate } from "react-router-dom";

// Import komponen Admin
import Dashboard from "../admin/pages/Dashboard";
import Events from "../admin/pages/Events";
import EventDetail from "../admin/pages/EventDetail";
import Login from "../admin/pages/Login";
import Register from "../admin/pages/Register";
import AuthElement from '../admin/components/layout/AuthElement'
import GuestElement from "../admin/components/layout/GuestElement";

const AdminRoutes = () => {
  return (
    
    <Routes>
      <Route element={<AuthElement />}>
        <Route path="/admin/dashboard" element={<Dashboard />} />
        <Route path="/admin/events" element={<Events />} />
        <Route path="/admin/events/:id" element={<EventDetail />} />
        {/* Redirect rute admin yang tidak ditemukan ke dashboard */}
        <Route path="/admin/*" element={<Navigate to="/admin/dashboard" />} />
      </Route>
      <Route element={<GuestElement />}>
        <Route path="/admin/login" element={<Login />} />
        <Route path="/admin/register" element={<Register />} />
        <Route path="/admin" element={<Navigate to="/admin/login" />} />
      </Route>
    </Routes>
  );
};

export default AdminRoutes;