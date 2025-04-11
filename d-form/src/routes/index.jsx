// File: src/routes/index.jsx
import { Route, Routes, Navigate, useLocation } from "react-router-dom";
import ClientRoutes from "./ClientRoutes";
import AdminRoutes from "./AdminRoutes";

// Import komponen layout Admin
import Sidebar from '../admin/components/layout/Sidebar';
import PageHeader from '../admin/components/layout/PageHeader';

// Import komponen layout Client
import ClientNavbar from "../client/components/Navbar";

const AppRoutes = () => {
  const location = useLocation();
  const path = location.pathname;
  
  // Cek apakah path saat ini adalah path admin
  const isAdminPath = path.startsWith('/admin');

  // Render layout berdasarkan path
  if (isAdminPath) {
    return <AdminLayout />;
  } else {
    return <ClientLayout />;
  }
};

// Komponen layout untuk Admin
const AdminLayout = () => {
  const location = useLocation();
  const isAuthPage = location.pathname === '/admin/login' || location.pathname === '/admin/register';
  
  if (isAuthPage) {
    // Tampilkan hanya konten auth tanpa sidebar dan header
    return <AdminRoutes />;
  }
  
  // Tampilkan layout admin lengkap dengan sidebar dan header
  return (
    <div className="flex min-h-screen bg-gray-100">
      <Sidebar />
      <div className="flex-grow">
        <PageHeader />
        <AdminRoutes />
      </div>
    </div>
  );
};

// Komponen layout untuk Client
const ClientLayout = () => {
  return (
    <>
      <ClientNavbar />
      <ClientRoutes />
    </>
  );
};

export default AppRoutes;