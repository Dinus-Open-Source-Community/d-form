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
      <div className="mt-16 sm:mt-22 bg-[#343434] text-white text-center py-16 sm:py-24 md:py-32 lg:py-40 px-4">
        <div className="flex flex-col sm:flex-row items-center justify-center mb-6 sm:mb-8">
          <div className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold">WELCOME TO D</div>
          <div className="text-3xl sm:text-4xl md:text-5xl lg:text-6xl sm:ml-2">FORM</div>
        </div>

        <button
          className="bg-white text-gray-800 font-semibold py-2 px-6 sm:px-8 md:px-10 rounded-lg hover:bg-gray-200 transition-colors cursor-pointer"
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