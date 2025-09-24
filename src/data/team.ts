import { TeamMember } from '@/types';

export const teamMembers: TeamMember[] = [
  {
    id: 'john-doe',
    name: 'John Doe',
    role: 'Chief Technology Officer',
    expertise: ['Cloud Architecture', 'DevOps', 'System Design'],
    avatar: '/img/staff-1.jpg'
  },
  {
    id: 'jane-smith',
    name: 'Jane Smith',
    role: 'Cybersecurity Lead',
    expertise: ['Penetration Testing', 'Security Consulting', 'Compliance'],
    avatar: '/img/staff-2.jpg'
  },
  {
    id: 'mike-johnson',
    name: 'Mike Johnson',
    role: 'AI/ML Engineer',
    expertise: ['Machine Learning', 'Natural Language Processing', 'Computer Vision'],
    avatar: '/img/staff-1-alt.jpg'
  }
];

export const getTeamMemberById = (id: string) => {
  return teamMembers.find(member => member.id === id);
};

export const getTeamMembersByExpertise = (expertise: string) => {
  return teamMembers.filter(member => 
    member.expertise.some(exp => 
      exp.toLowerCase().includes(expertise.toLowerCase())
    )
  );
};