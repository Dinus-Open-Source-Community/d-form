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
];

const todayEvent = events[0];
const upcomingEvents = events.slice(1);

const TodayEvent = ({ onEventClick }) => (
  <section className="mb-8">
    <h2 className="text-xl text-[#343434] mb-5">Today's Event</h2>
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <EventCard {...todayEvent} onEventClick={onEventClick} />
    </div>
  </section>
);

const UpcomingEvents = ({ onEventClick }) => (
  <section>
    <h2 className="text-xl text-[#343434] mb-5">Upcoming Events</h2>
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      {upcomingEvents.map((event) => (
        <EventCard key={event.id} {...event} onEventClick={onEventClick} />
      ))}
    </div>
  </section>
);

const EventList = ({ showToday = true, onEventClick }) => {
  return (
    <div className="py-8 px-12">
      {showToday && <TodayEvent onEventClick={onEventClick} />}
      <UpcomingEvents onEventClick={onEventClick} />
    </div>
  );
};

export default EventList;
