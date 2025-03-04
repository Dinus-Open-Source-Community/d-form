import EventCard from "./EventCard";

const events = [
  { 
    id: 1,
    category: ["RKT", "Programming"], 
    title: "Open Source on The School", 
    date: "21 - 24 October 2024"
  },
  { 
    id: 2,
    category: ["RKT", "Programming"], 
    title: "Open Source on The School", 
    date: "21 - 24 October 2024"
  },
  { 
    id: 3,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
  { 
    id: 4,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
  { 
    id: 5,
    category: ["NON-RKT", "Networking"], 
    title: "DOSCOM SHARING TIME: Docker", 
    date: "21 October 2024"
  },
];

const todayEvents = events.slice(0, 2); 
const upcomingEvents = events.slice(1); 

const TodayEvent = ({ onEventClick }) => (
  <section className="mb-6 sm:mb-8">
    <h2 className="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Today's Events</h2>
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      {todayEvents.map((event) => (
        <EventCard key={event.id} {...event} onEventClick={onEventClick} />
      ))}
    </div>
  </section>
);

const UpcomingEvents = ({ onEventClick }) => (
  <section>
    <h2 className="text-lg sm:text-1xl text-[#343434] mb-3 sm:mb-5 font-medium">Upcoming Events</h2>
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
      {upcomingEvents.map((event) => (
        <EventCard key={event.id} {...event} onEventClick={onEventClick} />
      ))}
    </div>
  </section>
);

const EventList = ({ showToday = true, onEventClick }) => {
  return (
    <div className="py-6 sm:py-8 px-4 sm:px-8 md:px-12">
      {showToday && <TodayEvent onEventClick={onEventClick} />}
      <UpcomingEvents onEventClick={onEventClick} />
    </div>
  );
};

export default EventList;