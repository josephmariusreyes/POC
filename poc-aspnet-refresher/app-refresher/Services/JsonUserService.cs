using System.Text.Json;
using app_refresher.Models;

namespace app_refresher.Services;

public class JsonUserService : IUserService
{
    private static readonly SemaphoreSlim FileLock = new(1, 1);
    private readonly string _usersFilePath;
    private readonly JsonSerializerOptions _jsonOptions = new()
    {
        PropertyNameCaseInsensitive = true,
        WriteIndented = true
    };

    public JsonUserService(IWebHostEnvironment environment)
    {
        _usersFilePath = Path.Combine(environment.ContentRootPath, "test-data", "users.json");
    }

    public async Task<User?> AuthenticateAsync(string username, string password)
    {
        var users = await ReadUsersAsync();
        return users.FirstOrDefault(u =>
            string.Equals(u.Username, username, StringComparison.OrdinalIgnoreCase)
            && string.Equals(u.Password, password, StringComparison.Ordinal));
    }

    public async Task<User?> GetByIdAsync(int id)
    {
        var users = await ReadUsersAsync();
        return users.FirstOrDefault(u => u.Id == id);
    }

    public async Task<bool> UpdateAsync(User updatedUser)
    {
        await FileLock.WaitAsync();
        try
        {
            var users = await ReadUsersAsync();
            var existingUser = users.FirstOrDefault(u => u.Id == updatedUser.Id);
            if (existingUser is null)
            {
                return false;
            }

            existingUser.Username = updatedUser.Username;
            existingUser.Email = updatedUser.Email;
            existingUser.FirstName = updatedUser.FirstName;
            existingUser.LastName = updatedUser.LastName;
            existingUser.Age = updatedUser.Age;
            existingUser.City = updatedUser.City;
            existingUser.Country = updatedUser.Country;
            existingUser.Phone = updatedUser.Phone;

            var updatedJson = JsonSerializer.Serialize(users, _jsonOptions);
            await File.WriteAllTextAsync(_usersFilePath, updatedJson);
            return true;
        }
        finally
        {
            FileLock.Release();
        }
    }

    private async Task<List<User>> ReadUsersAsync()
    {
        if (!File.Exists(_usersFilePath))
        {
            return new List<User>();
        }

        var content = await File.ReadAllTextAsync(_usersFilePath);
        if (string.IsNullOrWhiteSpace(content))
        {
            return new List<User>();
        }

        return JsonSerializer.Deserialize<List<User>>(content, _jsonOptions) ?? new List<User>();
    }
}
