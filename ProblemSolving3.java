import java.util.Scanner;

public class ProblemSolving3 {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Enter time in 12-hour format (hh:mm:ss AM/PM): ");
        String time12Hour = scanner.nextLine();

        String time24Hour = convert12HourTo24Hour(time12Hour);

        System.out.println("Time in 24-hour format: " + time24Hour);

        scanner.close();
    }

    private static String convert12HourTo24Hour(String time12Hour) {
        try {
            String[] parts = time12Hour.split(" ");
            String[] timeParts = parts[0].split(":");
            int hours = Integer.parseInt(timeParts[0]);
            int minutes = Integer.parseInt(timeParts[1]);
            int seconds = Integer.parseInt(timeParts[2]);

            if (parts[1].equalsIgnoreCase("PM") && hours != 12) {
                hours += 12;
            } else if (parts[1].equalsIgnoreCase("AM") && hours == 12) {
                hours = 0;
            }

            return String.format("%02d:%02d:%02d", hours, minutes, seconds);
        } catch (Exception e) {
            return "Invalid input. Please enter time in the correct format.";
        }
    }
}
