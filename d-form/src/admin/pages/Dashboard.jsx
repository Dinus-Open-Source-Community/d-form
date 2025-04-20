import React from "react";
import DashboardStats from "../components/dashboard/DashboardStats";
import EventList from "../components/dashboard/EventList";
import { useNavigate } from "react-router-dom";

function Dashboard() {
  const navigate = useNavigate();

  const handleEventClick = (eventId) => {
    navigate(`/admin/events/${eventId}`);
  };

  

  return (
    <div className="p-8 pt-28 ml-60">
      <h1 className="text-3xl font-bold mb-8">Dashboard</h1>
      <DashboardStats />
      {/* Menampilkan hanya ongoing events */}
      <EventList
        showToday={true} 
        showOngoing={false}
        showUpcoming={false}
        onEventClick={handleEventClick}
        showSeeAll={false} 
      />
    </div>
  );
}

export default Dashboard;
