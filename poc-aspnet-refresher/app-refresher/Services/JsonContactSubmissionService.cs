using System.Text.Json;
using app_refresher.Models;

namespace app_refresher.Services;

public class JsonContactSubmissionService : IContactSubmissionService
{
    private static readonly SemaphoreSlim FileLock = new(1, 1);
    private readonly string _contactSubmissionsFilePath;
    private readonly JsonSerializerOptions _jsonOptions = new()
    {
        PropertyNameCaseInsensitive = true,
        WriteIndented = true
    };

    public JsonContactSubmissionService(IWebHostEnvironment environment)
    {
        _contactSubmissionsFilePath = Path.Combine(environment.ContentRootPath, "test-data", "contact-us-submission.json");
    }

    public async Task AddSubmissionAsync(ContactSubmission submission)
    {
        await FileLock.WaitAsync();
        try
        {
            var submissions = await ReadSubmissionsAsync();
            submissions.Add(submission);

            var updatedJson = JsonSerializer.Serialize(submissions, _jsonOptions);
            await File.WriteAllTextAsync(_contactSubmissionsFilePath, updatedJson);
        }
        finally
        {
            FileLock.Release();
        }
    }

    private async Task<List<ContactSubmission>> ReadSubmissionsAsync()
    {
        if (!File.Exists(_contactSubmissionsFilePath))
        {
            return new List<ContactSubmission>();
        }

        var content = await File.ReadAllTextAsync(_contactSubmissionsFilePath);
        if (string.IsNullOrWhiteSpace(content))
        {
            return new List<ContactSubmission>();
        }

        return JsonSerializer.Deserialize<List<ContactSubmission>>(content, _jsonOptions) ?? new List<ContactSubmission>();
    }
}
