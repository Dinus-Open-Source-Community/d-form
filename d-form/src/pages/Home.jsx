import React from "react";
import EventList from "../components/EventList";
import { useNavigate } from "react-router-dom";

const Home = () => {
  const navigate = useNavigate();

  const handleEventClick = (eventId) => {
    navigate(`/events/${eventId}`);
  };

return (
    <>
        <div className="bg-[#343434] text-white text-center py-40">
            <div className="flex items-center justify-center mb-8">
                <div className="text-7xl font-bold">WELCOME TO D</div>
                <div className="text-6xl ml-2">FORM</div>
            </div>

            <button
                className="bg-white text-gray-800 font-semibold py-2 px-10 rounded-lg hover:bg-gray-200 transition-colors"
                onClick={() => navigate('/events')}
            >
                See All Events
            </button>
        </div>

        {/* Menampilkan hanya upcoming events */}
        <EventList showToday={false} onEventClick={handleEventClick} />
    </>
);
};

export default Home;
